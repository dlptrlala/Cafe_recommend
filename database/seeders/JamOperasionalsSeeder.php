<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JamOperasionalsSeeder extends Seeder
{
    public function run()
    {
        DB::table('jam_operasionals')->insert([
            [
                'idCafe' => 1,
                'jadwal' => '[{"hari":["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka":"08:00", "jam_tutup":"00:00"}]',
            ],
            [
                'idCafe' => 2,
                'jadwal' => '[{"hari":["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka":"00:00", "jam_tutup":"00:00"}]',
            ],
            [
                'idCafe' => 3,
                'jadwal' => '[{"hari":["Senin", "Selasa", "Rabu", "Kamis"], "jam_buka":"10:00", "jam_tutup":"23:00"}, {"hari":["Jumat", "Sabtu", "Minggu"], "jam_buka":"07:00", "jam_tutup":"23:00"}]',
            ],
            [
                'idCafe' => 4,
                'jadwal' => '[{"hari":["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka":"08:00", "jam_tutup":"23:00"}]',
            ],
            [
                'idCafe' => 5,
                'jadwal' => '[{"hari":["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka":"08:00", "jam_tutup":"22:00"}]',
            ],
            [
                'idCafe' => 6,
                'jadwal' => '[{"hari":["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka":"10:00", "jam_tutup":"01:00"}]',
            ],
            [
                'idCafe' => 7,
                'jadwal' => '[{"hari":["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka":"07:00", "jam_tutup":"23:00"}]',
            ],
            [
                'idCafe' => 8,
                'jadwal' => '[{"hari":["Senin", "Selasa", "Rabu", "Kamis", "Jumat"], "jam_buka":"07:15", "jam_tutup":"22:45"}, {"hari":["Sabtu", "Minggu"], "jam_buka":"09:00", "jam_tutup":"22:45"}]',
            ],
            [
                'idCafe' => 9,
                'jadwal' => '[{"hari":["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka":"15:00", "jam_tutup":"23:00"}]',
            ],
            [
                'idCafe' => 10,
                'jadwal' => '[{"hari":["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka":"08:00", "jam_tutup":"23:00"}]',
            ],
            [
                'idCafe' => 11,
                'jadwal' => '[{"hari":["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka":"07:00", "jam_tutup":"22:00"}]',
            ],
            [
                'idCafe' => 12,
                'jadwal' => '[{"hari":["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka":"08:00", "jam_tutup":"22:00"}]',
            ],
            [
                'idCafe' => 13,
                'jadwal' => '[{"hari":["Senin", "Selasa", "Rabu", "Kamis", "Jumat"], "jam_buka":"09:00", "jam_tutup":"00:00"}, {"hari":["Sabtu", "Minggu"], "jam_buka":"07:00", "jam_tutup":"00:00"}]',
            ],
            [
                'idCafe' => 14,
                'jadwal' => '[{"hari":["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka":"08:00", "jam_tutup":"23:00"}]',
            ],
            [
                'idCafe' => 15,
                'jadwal' => '[{"hari":["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka":"07:00", "jam_tutup":"22:00"}]',
            ],
            [
                'idCafe' => 16,
                'jadwal' => '[{"hari":["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka":"08:00", "jam_tutup":"23:00"}]',
            ],
            [
                'idCafe' => 17,
                'jadwal' => '[{"hari":["Senin", "Selasa", "Rabu", "Kamis", "Sabtu", "Minggu"], "jam_buka":"10:00", "jam_tutup":"23:00"}, {"hari":["Jumat"], "jam_buka":"13:00", "jam_tutup":"23:00"}]',
            ],
            [
                'idCafe' => 18,
                'jadwal' => '[{"hari":["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka":"11:00", "jam_tutup":"02:00"}]',
            ],
            [
                'idCafe' => 19,
                'jadwal' => '[{"hari":["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka":"11:00", "jam_tutup":"23:00"}]',
            ],
            [
                'idCafe' => 20,
                'jadwal' => '[{"hari":["Senin", "Selasa", "Rabu", "Kamis", "Jumat"], "jam_buka":"10:00", "jam_tutup":"22:00"}, {"hari":["Sabtu", "Minggu"], "jam_buka":"09:00", "jam_tutup":"22:00"}]',
            ],
            [
                'idCafe' => 21,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "09:00", "jam_tutup": "23:00"}]',
            ],
            [
                'idCafe' => 22,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "08:00", "jam_tutup": "22:00"}]',
            ],
            [
                'idCafe' => 23,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "16:00", "jam_tutup": "00:00"}]',
            ],
            [
                'idCafe' => 24,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "08:00", "jam_tutup": "22:00"}]',
            ],
            [
                'idCafe' => 25,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "09:00", "jam_tutup": "00:00"}]',
            ],
            [
                'idCafe' => 26,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "09:00", "jam_tutup": "00:00"}]',
            ],
            [
                'idCafe' => 27,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "09:00", "jam_tutup": "23:00"}]',
            ],
            [
                'idCafe' => 28,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "07:00", "jam_tutup": "23:00"}]',
            ],
            [
                'idCafe' => 29,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "08:30", "jam_tutup": "23:30"}]',
            ],
            [
                'idCafe' => 30,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "00:00", "jam_tutup": "00:00"}]',
            ],
            [
                'idCafe' => 31,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "13:00", "jam_tutup": "04:00"}]',
            ],
            [
                'idCafe' => 32,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "10:00", "jam_tutup": "22:00"}]',
            ],
            [
                'idCafe' => 33,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "00:00", "jam_tutup": "00:00"}]',
            ],
            [
                'idCafe' => 34,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "08:00", "jam_tutup": "23:00"}]',
            ],
            [
                'idCafe' => 35,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "10:00", "jam_tutup": "23:00"}]',
            ],
            [
                'idCafe' => 36,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "10:00", "jam_tutup": "22:00"}]',
            ],
            [
                'idCafe' => 37,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "09:00", "jam_tutup": "23:00"}]',
            ],
            [
                'idCafe' => 38,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "11:00", "jam_tutup": "23:00"}]',
            ],
            [
                'idCafe' => 39,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "08:00", "jam_tutup": "23:00"}]',
            ],
            [
                'idCafe' => 40,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "10:00", "jam_tutup": "00:00"}]',
            ],
            [
                'idCafe' => 41,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"],"jam_buka":"09:00","jam_tutup":"21:00"}]',
            ],
            [
                'idCafe' => 42,
                'jadwal' => '[{"hari":["Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"],"jam_buka":"11:00","jam_tutup":"22:00"},{"hari":["Senin"],"jam_buka":null,"jam_tutup":null}]',
            ],
            [
                'idCafe' => 43,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"],"jam_buka":"07:00","jam_tutup":"21:00"}]',
            ],
            [
                'idCafe' => 44,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"],"jam_buka":"08:00","jam_tutup":"23:30"}]',
            ],
            [
                'idCafe' => 45,
                'jadwal' => '[{"hari":["Minggu","Senin","Selasa","Rabu","Kamis","Jumat"],"jam_buka":"10:00","jam_tutup":"22:30"},{"hari":["Sabtu"],"jam_buka":"10:00","jam_tutup":"23:30"}]',
            ],
            [
                'idCafe' => 46,
                'jadwal' => '[{"hari":["Minggu","Senin","Selasa","Rabu","Kamis","Jumat"],"jam_buka":"14:00","jam_tutup":"23:00"},{"hari":["Sabtu"],"jam_buka":"14:00","jam_tutup":"00:00"}]',
            ],
            [
                'idCafe' => 47,
                'jadwal' => '[{"hari":["Kamis","Jumat","Sabtu","Minggu","Senin","Selasa"],"jam_buka":"10:00","jam_tutup":"22:00"},{"hari":["Rabu"],"jam_buka":null,"jam_tutup":null}]',
            ],
            [
                'idCafe' => 48,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"],"jam_buka":"10:00","jam_tutup":"22:00"}]',
            ],
            [
                'idCafe' => 49,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"],"jam_buka":"10:00","jam_tutup":"23:30"}]',
            ],
            [
                'idCafe' => 50,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"],"jam_buka":"00:00","jam_tutup":"00:00"}]',
            ],
            [
                'idCafe' => 51,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat"],"jam_buka":"16:00","jam_tutup":"22:30"},{"hari":["Sabtu","Minggu"],"jam_buka":"16:00","jam_tutup":"23:00"}]',
            ],
            [
                'idCafe' => 52,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"],"jam_buka":"10:00","jam_tutup":"00:00"}]',
            ],
            [
                'idCafe' => 53,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"],"jam_buka":"18:00","jam_tutup":"00:00"},{"hari":["Minggu"],"jam_buka":null,"jam_tutup":null}]',
            ],
            [
                'idCafe' => 54,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"],"jam_buka":"11:00","jam_tutup":"22:00"}]',
            ],
            [
                'idCafe' => 55,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"],"jam_buka":"08:00","jam_tutup":"23:00"}]',
            ],
            [
                'idCafe' => 56,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis"],"jam_buka":"08:00","jam_tutup":"00:00"},{"hari":["Jumat","Sabtu","Minggu"],"jam_buka":"08:00","jam_tutup":"02:00"}]',
            ],
            [
                'idCafe' => 57,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"],"jam_buka":"12:00","jam_tutup":"00:00"}]',
            ],
            [
                'idCafe' => 58,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"],"jam_buka":"09:00","jam_tutup":"20:00"}]',
            ],
            [
                'idCafe' => 59,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"],"jam_buka":"00:00","jam_tutup":"00:00"}]',
            ],
            [
                'idCafe' => 60,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"],"jam_buka":"10:00","jam_tutup":"22:00"}]',
            ],
            [
                'idCafe' => 61,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat"],"jam_buka":"10:00","jam_tutup":"21:00"},{"hari":["Sabtu","Minggu"],"jam_buka":"07:00","jam_tutup":"21:00"}]',
            ],
            [
                'idCafe' => 62,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"],"jam_buka":"10:00","jam_tutup":"22:00"}]',
            ],
            [
                'idCafe' => 63,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"],"jam_buka":"07:00","jam_tutup":"21:00"}]',
            ],
            [
                'idCafe' => 64,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat"],"jam_buka":"14:00","jam_tutup":"22:00"},{"hari":["Sabtu","Minggu"],"jam_buka":"09:00","jam_tutup":"22:00"}]',
            ],
            [
                'idCafe' => 65,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"],"jam_buka":"09:00","jam_tutup":"00:00"}]',
            ],
            [
                'idCafe' => 66,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"],"jam_buka":"07:00","jam_tutup":"22:00"}]',
            ],
            [
                'idCafe' => 67,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"],"jam_buka":"09:00","jam_tutup":"00:00"}]',
            ],
            [
                'idCafe' => 68,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"],"jam_buka":"08:00","jam_tutup":"23:30"}]',
            ],
            [
                'idCafe' => 69,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"],"jam_buka":"08:00","jam_tutup":"21:00"}]',
            ],
            [
                'idCafe' => 70,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat"],"jam_buka":"09:00","jam_tutup":"22:00"},{"hari":["Sabtu","Minggu"],"jam_buka":"08:00","jam_tutup":"22:00"}]',
            ],
            [
                'idCafe' => 71,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat"],"jam_buka":"11:00","jam_tutup":"22:00"},{"hari":["Sabtu","Minggu"],"jam_buka":"06:00","jam_tutup":"22:00"}]',
            ],
            [
                'idCafe' => 72,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"],"jam_buka":"07:00","jam_tutup":"21:00"}]',
            ],
            [
                'idCafe' => 73,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"],"jam_buka":"09:00","jam_tutup":"23:00"}]',
            ],
            [
                'idCafe' => 74,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"],"jam_buka":"14:00","jam_tutup":"22:00"}]',
            ],
            [
                'idCafe' => 75,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"],"jam_buka":"07:00","jam_tutup":"23:00"}]',
            ],
            [
                'idCafe' => 76,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu"],"jam_buka":null,"jam_tutup":null},{"hari":["Kamis","Jumat","Sabtu","Minggu"],"jam_buka":"13:00","jam_tutup":"21:00"}]',
            ],
            [
                'idCafe' => 77,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"],"jam_buka":"08:00","jam_tutup":"20:00"}]',
            ],
            [
                'idCafe' => 78,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat"],"jam_buka":"09:00","jam_tutup":"20:00"},{"hari":["Sabtu","Minggu"],"jam_buka":"08:00","jam_tutup":"20:00"}]',
            ],
            [
                'idCafe' => 79,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"],"jam_buka":"08:00","jam_tutup":"23:00"}]',
            ],
            [
                'idCafe' => 80,
                'jadwal' => '[{"hari":["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"],"jam_buka":"11:00","jam_tutup":"21:00"},{"hari":["Minggu"],"jam_buka":"07:00","jam_tutup":"21:00"}]',
            ],
            [
                'idCafe' => 81,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "11:00", "jam_tutup": "23:00"}]',
            ],
            [
                'idCafe' => 82,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "08:00", "jam_tutup": "23:00"}]',
            ],
            [
                'idCafe' => 83,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "10:00", "jam_tutup": "00:00"}]',
            ],
            [
                'idCafe' => 84,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "12:00", "jam_tutup": "22:00"}]',
            ],
            [
                'idCafe' => 85,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Jumat", "Sabtu", "Minggu"], "jam_buka": "16:00", "jam_tutup": "23:00"}, {"hari": ["Kamis"], "jam_buka": null, "jam_tutup": null}]',
            ],
            [
                'idCafe' => 86,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "11:00", "jam_tutup": "23:00"}]',
            ],
            [
                'idCafe' => 87,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "07:00", "jam_tutup": "22:00"}]',
            ],
            [
                'idCafe' => 88,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "09:00", "jam_tutup": "22:00"}]',
            ],
            [
                'idCafe' => 89,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Sabtu", "Minggu"], "jam_buka": "11:00", "jam_tutup": "23:00"}, {"hari": ["Jumat"], "jam_buka": "14:30", "jam_tutup": "23:00"}]',
            ],
            [
                'idCafe' => 90,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "09:00", "jam_tutup": "18:00"}]',
            ],
            [
                'idCafe' => 91,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "10:00", "jam_tutup": "22:00"}]',
            ],
            [
                'idCafe' => 92,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "10:15", "jam_tutup": "22:25"}]',
            ],
            [
                'idCafe' => 93,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat"], "jam_buka": "12:00", "jam_tutup": "20:00"}, {"hari": ["Sabtu", "Minggu"], "jam_buka": "10:00", "jam_tutup": "22:00"}]',
            ],
            [
                'idCafe' => 94,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Sabtu", "Minggu"], "jam_buka": "10:00", "jam_tutup": "22:00"}, {"hari": ["Jumat"], "jam_buka": "13:00", "jam_tutup": "22:00"}]',
            ],
            [
                'idCafe' => 95,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Sabtu", "Minggu"], "jam_buka": "12:00", "jam_tutup": "02:00"}, {"hari": ["Jumat"], "jam_buka": "13:00", "jam_tutup": "02:00"}]',
            ],
            [
                'idCafe' => 96,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "15:00", "jam_tutup": "23:30"}]',
            ],
            [
                'idCafe' => 97,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat"], "jam_buka": "10:00", "jam_tutup": "22:00"}, {"hari": ["Sabtu", "Minggu"], "jam_buka": "07:30", "jam_tutup": "23:00"}]',
            ],
            [
                'idCafe' => 98,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "07:00", "jam_tutup": "00:00"}]',
            ],
            [
                'idCafe' => 99,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "09:00", "jam_tutup": "00:00"}]',
            ],
            [
                'idCafe' => 100,
                'jadwal' => '[{"hari": ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"], "jam_buka": "07:00", "jam_tutup": "16:00"}]',
            ],
        ]);
    }
}
