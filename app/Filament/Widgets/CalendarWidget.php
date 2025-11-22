<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Appointments\AppointmentResource;
use App\Filament\Resources\Appointments\Schemas\AppointmentForm;
use App\Models\Appointment;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Grid;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
use Saade\FilamentFullCalendar\Actions\CreateAction;
use Filament\Schemas\Schema;



class CalendarWidget extends FullCalendarWidget
{
    /**
     * FullCalendar will call this function whenever it needs new event data.
     * This is triggered when the user clicks prev/next or switches views on the calendar.
     */
    public string|null|\Illuminate\Database\Eloquent\Model $model = Appointment::class;

    public function config(): array
    {
        return [
            'firstDay' => 1,
            'headerToolbar' => [
                'start' => 'dayGridWeek dayGridDay dayGridMonth',
                'center' => 'title',
                'right' => 'prev,next today',
            ],
        ];
    }

    public function fetchEvents(array $fetchInfo): array
    {
        return Appointment::query()
            ->where('scheduled_at', '>=', $fetchInfo['start'])
            ->where('end_at', '<=', $fetchInfo['end'])
            ->get()
            ->map(
                fn (Appointment $event) => [
                    'title' => $event->nomeEvento(),
                    'start' => $event->scheduled_at,
                    'end' => $event->end_at,
                    'url' => AppointmentResource::getUrl(name: 'edit', parameters: ['record' => $event]),
                    'shouldOpenUrlInNewTab' => true
                ]
            )
            ->all();
    }

    public function getFormSchema(): array
    {
        return [
            Grid::make(2)
                ->schema(\App\Filament\Resources\Appointments\Schemas\AppointmentForm::schema()),
        ];
    }

    protected function headerActions(): array
    {
        return [
            CreateAction::make()
                ->label('Criar Agendamento')
                ->modalHeading('Criar Agendamento')
                ->mountUsing(
                    function ($form, array $arguments) {
                        $form->fill([
                            'scheduled_at' => $arguments['start'] ?? null,
                        ]);
                    }
                )
        ];
    }
}
