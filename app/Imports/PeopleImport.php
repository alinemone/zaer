<?php

namespace App\Imports;

use App\Models\AllocatedBed;
use App\Models\Group;
use App\Models\People;
use App\Models\GroupMember;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class PeopleImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{

    public function collection(Collection $collection)
    {
        return app('db')->transaction(function () use ($collection) {

            /** @var Collection $groupMembers */
            $groupMembers = Group::find(request()->id)->people()->get();

            // Delete everybody that remove in the file
            foreach ($groupMembers as $groupMember) {

                if ($collection->where('national_code', $groupMember->national_code)->isEmpty()) {
                    // Remove from group members
                    GroupMember::where(GroupMember::PEOPLE_ID, $groupMember->id)->delete();

                    // remove allocated bed.
                    AllocatedBed::where(AllocatedBed::PEOPLE_ID, $groupMember->id)->delete();
                }

            }

            foreach ($collection as $row) {

                $people = People::firstOrCreate(
                    [
                        People::NATIONAL_CODE => $row['national_code']
                    ],
                    [
                        People::NAME_FAMILY   => $row['name_family'],
                        People::NATIONAL_CODE => $row['national_code'],
                        People::MOBILE        => $row['mobile'],
                        People::GENDER        => $row['gender'],
                        People::COUNTRY       => request()->country,
                        People::PROVINCE      => request()->province,
                        People::CITY          => request()->city,

                    ]);

                GroupMember::firstOrCreate(
                    [
                        GroupMember::GROUP_ID  => request()->id,
                        GroupMember::PEOPLE_ID => $people->id
                    ],
                    [
                        GroupMember::GROUP_ID  => request()->id,
                        GroupMember::PEOPLE_ID => $people->id
                    ]
                );
            }

        });
    }
}
