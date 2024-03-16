<?php

namespace AndreasNik\Ticket\Services\Concerns;

use AndreasNik\Ticket\Models\TicketResponse;
use AndreasNik\Ticket\Services\TicketService;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\Exception\CannotWriteFileException;

trait Response
{
    /**
     * @param Model $entity
     * @param string $reply
     * @param Collection $attachments
     * @return TicketService
     */
    public function replyAsEntity(Model $entity, string $reply, Collection $attachments): TicketService
    {
        $data = [
            'entity_id' => $entity->getKey(),
            'message' => $reply,
            'created_by' => $entity->getKey()
        ];

        return $this->reply($data, $attachments);
    }


    /**
     * @param int $userID
     * @param Model $entity
     * @param string $reply
     * @param Collection $attachments
     * @return TicketService
     */
    public function replyAsUser(int $userID, Model $entity, string $reply, Collection $attachments): TicketService
    {
        $data = [
            'entity_id' => $entity->getKey(),
            'user_id' => $userID,
            'message' => $reply,
            'created_by' => $userID
        ];

        return $this->reply($data, $attachments);
    }

    public function reply(array $data, Collection $attachments): TicketService
    {
        /**
         * @var TicketResponse $response
         */
        $response = $this->ticket->responses()->create($data);

        $this->handleAttachments($response, $attachments);

        return $this->refreshTicket();
    }



    /**
     * @param TicketResponse $response
     * @param Collection $attachments
     * @return void
     */
    private function handleAttachments(TicketResponse $response, Collection $attachments)
    {
        $destinationPath = "{$response->ticket->entity_type}-portal/support/{$response->ticket_id}/{$response->ticket_id}";

        $inserted = $attachments->map(
        /**
         * @throws FileNotFoundException
         */
            function (UploadedFile $file) use ($response, $destinationPath) {
                $name = time() . '-ticket.' . $file->extension();
                $path = "{$destinationPath}-{$name}";

                $attachmentContent = $file->get();
                $s3Upload = Storage::disk("s3")->put($path, $attachmentContent);
                if ($s3Upload === false) {
                    throw new CannotWriteFileException('Can not upload file');
                }

                $fileName = "{$response->ticket_id}-$name";

                return [
                    'ticket_id' => $response->ticket_id,
                    'attachment_name' => $fileName,
                    'attachment_name_original' => $fileName,
                ];
            });

        $response->attachments()->createMany($inserted->toArray());
    }
}