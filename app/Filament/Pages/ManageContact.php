<?php

namespace App\Filament\Pages;

use App\Models\Contact;
use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;

class ManageContact extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-phone';
    protected static string $view = 'filament.pages.manage-contact';
    protected static ?string $navigationGroup = 'Content';

    public static function getNavigationLabel(): string
    {
        return 'Kontak';
    }

    public static function getNavigationSort(): ?int
    {
        return 3;
    }

    public ?Contact $contact = null;

    public array $formData = [];

    public function mount(): void
    {
        $this->contact = Contact::firstOrCreate([], [
            'name' => 'Default Name',
            'email' => 'email@example.com',
            'phone' => '08xxxx',
            'address' => 'Alamat default',
        ]);

        $this->formData = [
            'name' => $this->contact->name,
            'email' => $this->contact->email,
            'phone' => $this->contact->phone,
            'address' => $this->contact->address,
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required()->label('Nama Kontak'),
                Forms\Components\TextInput::make('email')->required()->email(),
                Forms\Components\TextInput::make('phone')->required()->label('No. Telepon'),
                Forms\Components\Textarea::make('address')->required()->label('Alamat'),
            ])
            ->statePath('formData');
    }

    public function save(): void
    {
        $this->contact->update($this->formData);

        Notification::make()
            ->title('Berhasil')
            ->body('Informasi kontak berhasil diperbarui.')
            ->success()
            ->send();
    }
}
