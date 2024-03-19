<?php

namespace AndreasNik\Ticket\Tests\Unit;

use AndreasNik\Ticket\Database\Factories\AffiliateFactory;
use AndreasNik\Ticket\Database\Factories\CategoryFactory;
use AndreasNik\Ticket\Database\Factories\ClientFactory;
use AndreasNik\Ticket\Models\Ticket;
use AndreasNik\Ticket\Models\TicketResponse;
use AndreasNik\Ticket\Tests\TestCase;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class TicketTest extends TestCase
{

    public function providesEntity(): array
    {
        return [
            ['client', ClientFactory::class],
            ['affiliate', AffiliateFactory::class]
        ];
    }

    /**
     * @dataProvider providesEntity
     * @throws BindingResolutionException
     */
    public function test_new_ticket_with_attachment(string $entity, $factory)
    {
        Storage::fake('s3');
        $model = app()->make($factory)->create();
        $category = app()->make(CategoryFactory::class)->create(['entity_type' => $entity]);

        $ticketData = [
            'category_id' => $category->getKey(),
            'subject' => 'test ticket'
        ];

        $attachments = collect([
            File::fake()->create('note_attachment1_test.png'),
            File::fake()->create('note_attachment2_test.png')
        ]);

        $this->createAs($entity, $model, $ticketData, $attachments);
        $this->createAs($entity, $model, $ticketData, $attachments, true);
    }

    /**
     * @throws BindingResolutionException
     */
    private function createAs(string $entity, Model $model, array $ticketData, Collection $attachments, bool $asUser = false)
    {
        $ticket = helpdesk($entity)->ticket();

        $ticket = $asUser ? $ticket->createAsUser(112, $model, $ticketData, $attachments) : $ticket->createAsEntity($model, $ticketData);

        $ticketObject = $ticket->getTicket();

        helpdesk($entity)->ticket($ticket->getTicket()->getKey())->reply([
            'entity_id' => $ticketObject->entity_id,
            'response_number' => 1,
            'message' => 'Ticket Description',
        ], $attachments);

        $ticketObject = $ticket->getTicket();

        $this->assertDatabaseHas(Ticket::class, array_except($ticketObject->toArray(), ['created_on', 'modified_on']));

        $this->assertDatabaseHas(TicketResponse::class, array_except($ticketObject->responses->first()->toArray(), ['created_on', 'modified_on']));

        $this->assertCount(2, $ticketObject->attachments);
    }
}