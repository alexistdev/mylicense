<?php

namespace Database\Seeders;

use App\Models\Detailuser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class DetailuserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $detail = array(
            [
                'user_id'=>1,
                'phone'=> '082371408678',
                'alamat' => 'Jl.Bendungan Wayngison No.237, Sidodadi',
                'first_name' => 'Alexsander',
                'last_name' => 'Hendra Wijaya',
                'city' => 'Pringsewu',
                'state' => 'Lampung',
                'country'=> 'Indonesia',
                'created_at'=> $date,
                'updated_at' => $date,
            ],
            [
                'user_id'=> 2,
                'phone'=> '082371408678',
                'alamat' => 'Jl.Bendungan Wayngison No.237, Sidodadi',
                'first_name' => 'Alexsander',
                'last_name' => 'Hendra Wijaya',
                'city' => 'Pringsewu',
                'state' => 'Lampung',
                'country'=> 'Indonesia',
                'created_at'=> $date,
                'updated_at' => $date,
            ],
            [
                'user_id'=> 3,
                'phone'=> '082371408678',
                'alamat' => 'Jl.Bendungan Wayngison No.237, Sidodadi',
                'first_name' => 'Alexsander',
                'last_name' => 'Hendra Wijaya',
                'city' => 'Pringsewu',
                'state' => 'Lampung',
                'country'=> 'Indonesia',
                'created_at'=> $date,
                'updated_at' => $date,
            ],
            [
                'user_id'=> 4,
                'phone'=> '082371408678',
                'alamat' => 'Jl.Bendungan Wayngison No.237, Sidodadi',
                'first_name' => 'Alexsander',
                'last_name' => 'Hendra Wijaya',
                'city' => 'Pringsewu',
                'state' => 'Lampung',
                'country'=> 'Indonesia',
                'created_at'=> $date,
                'updated_at' => $date,
            ],
        );
        Detailuser::insert($detail);
    }
}
