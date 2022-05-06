<?php

namespace App\Imports;

use App\Models\Contact;
use App\Models\Phonebook;
use App\Models\Team;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContactsImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, SkipsOnFailure, SkipsEmptyRows
{
    use Importable, SkipsFailures;

    private Phonebook $phonebook;
    private Team $team_id;

    public function __construct(Team $team_id, Phonebook $phonebook)
    {
        $this->team_id = $team_id;
        $this->phonebook = $phonebook;
    }

    public function model(array $row): Contact|null
    {
        $phone_national = preg_replace('[^0-9]', '', phone($row['phone'], $row['phone_country'])->formatNational());
        $phone_e164 = phone($row['phone'], $row['phone_country'])->formatE164();
        $phone = preg_replace('[^0-9]', '', $row['phone']);

        return new Contact([
            'first_name'     => $row['first_name'],
            'last_name'      => $row['last_name'],
            'phone_country'  => $row['phone_country'],
            'phone'          => $phone,
            'phone_e164'     => $phone_e164,
            'phone_national' => $phone_national,
            'unit'           => $row['unit'],
            'city'           => $row['city'],
            'address'        => $row['address'],
            'state'          => $row['state'],
            'lga'            => $row['lga'],
            'business'       => $row['business'],
            'country'        => $row['country'],
            'region'         => $row['region'],
            'team_id'        => $this->team_id->id,
            'phonebook_id'   => $this->phonebook->id,
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 5000;
    }


    public function rules(): array
    {
        return [
            'first_name'    => ['required', 'max:256'],
            'last_name'     => ['required', 'max:256'],
            'phone_country' => ['required', 'max:2'],
            'phone'         => ['required', Rule::phone()->countryField('phone_country')],
            'email'         => ['present', 'nullable', 'email', 'max:256'],
            'address'       => ['present', 'nullable', 'string', 'max:256'],
            'city'          => ['present', 'nullable', 'string', 'max:256'],
            'unit'          => ['present', 'nullable', 'string', 'max:256'],
            'lga'           => ['present', 'nullable', 'string', 'max:256'],
            'state'         => ['present', 'nullable', 'string', 'max:256'],
            'region'        => ['present', 'nullable', 'string', 'max:256'],
            'country'       => ['present', 'nullable', 'string', 'max:256'],
            'business'      => ['present', 'nullable', 'string', 'max:256'],
        ];
    }
}
