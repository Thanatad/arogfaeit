<?php

use Illuminate\Database\Seeder;

class daylists extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('daylists')->insert([
            [
            'id' => 1,
            'name' => 'วันขึ้นปีใหม่',
            'type' => 'วันหยุดราชการ',
            'date' => '2000-01-01',
            ],
            [
            'id' => 2,
            'name' => 'วันสงกรานต์',
            'type' => 'วันหยุดราชการ',
            'date' => '2000-04-13',
            ],
            [
            'id' => 3,
            'name' => 'วันสงกรานต์',
            'type' => 'วันหยุดราชการ',
            'date' => '2000-04-14',
            ],
            [
            'id' => 4,
            'name' => 'วันสงกรานต์',
            'type' => 'วันหยุดราชการ',
            'date' => '2000-04-15',
            ],
            [
            'id' => 5,
            'name' => 'วันผู้สูงอายุ',
            'type' => 'วันหยุดราชการ',
            'date' => '2000-04-13',
            ],
            [
            'id' => 6,
            'name' => 'วันครอบครัว',
            'type' => 'วันหยุดราชการ',
            'date' => '2000-04-14',
            ],
            [
            'id' => 7,
            'name' => 'วันเถลิงศก',
            'type' => 'วันหยุดราชการ',
            'date' => '2000-04-15',
            ],
            [
            'id' => 8,
            'name' => 'วันพืชมงคล',
            'type' => 'วันหยุดราชการ',
            'date' => '1000-01-01',
            ],
            [
            'id' => 9,
            'name' => 'วันเฉลิมพระชนมพรรษาของสมเด็จพระเจ้าอยู่หัวมหาวชิราลงกรณ บดินทรเทพยวรางกูร',
            'type' => 'วันหยุดราชการ',
            'date' => '2000-07-28',
            ],
            [
            'id' => 10,
            'name' => 'วันแม่แห่งชาติ',
            'type' => 'วันหยุดราชการ',
            'date' => '2000-08-12',
            ],
            [
            'id' => 11,
            'name' => 'วันคล้ายวันสวรรคตของพระบาทสมเด็จพระปรมินทรมหาภูมิพลอดุลยเดช บรมนาถบพิตร',
            'type' => 'วันหยุดราชการ',
            'date' => '2000-10-13',
            ],
            [
            'id' => 12,
            'name' => 'วันปิยมหาราช',
            'type' => 'วันหยุดราชการ',
            'date' => '2000-10-23',
            ],
            [
            'id' => 13,
            'name' => 'วันคล้ายวันเฉลิมพระชนมพรรษาของพระบาทสมเด็จพระปรมินทรมหาภูมิพลอดุลยเดช บรมนาถบพิตร',
            'type' => 'วันหยุดราชการ',
            'date' => '2000-12-05',
            ],
            [
            'id' => 14,
            'name' => 'วันชาติ',
            'type' => 'วันหยุดราชการ',
            'date' => '2000-12-05',
            ],
            [
            'id' => 15,
            'name' => 'วันพ่อแห่งชาติ',
            'type' => 'วันหยุดราชการ',
            'date' => '2000-12-05',
            ],
            [
            'id' => 16,
            'name' => 'วันดินโลก',
            'type' => 'วันหยุดราชการ',
            'date' => '2000-12-05',
            ],
            [
            'id' => 17,
            'name' => 'วันรัฐธรรมนูญ',
            'type' => 'วันหยุดราชการ',
            'date' => '2000-12-10',
            ],
            [
            'id' => 18,
            'name' => 'วันสิ้นปี',
            'type' => 'วันหยุดราชการ',
            'date' => '2000-12-31',
            ],
            [
            'id' => 19,
            'name' => 'วันมาฆบูชา',
            'type' => 'วันทางศาสนา',
            'date' => '1000-01-01',
            ],
            [
            'id' => 20,
            'name' => 'วันวิสาขบูชา',
            'type' => 'วันทางศาสนา',
            'date' => '1000-01-01',
            ],
            [
            'id' => 21,
            'name' => 'วันอาสาฬหบูชา',
            'type' => 'วันทางศาสนา',
            'date' => '1000-01-01',
            ],
            [
            'id' => 22,
            'name' => 'วันเข้าพรรษา',
            'type' => 'วันทางศาสนา',
            'date' => '1000-01-01',
            ],
            [
            'id' => 23,
            'name' => 'วันปวารณาออกพรรษา',
            'type' => 'วันทางศาสนา',
            'date' => '1000-01-01',
            ],
            [
            'id' => 24,
            'name' => 'วันเทโวโรหณะ',
            'type' => 'วันทางศาสนา',
            'date' => '1000-01-01',
            ],
            [
            'id' => 25,
            'name' => 'วันเด็กแห่งชาติ',
            'type' => 'ไม่ใช่วันหยุดราชการ',
            'date' => '1000-01-01',
            ],
            [
            'id' => 26,
            'name' => 'วันครู',
            'type' => 'ไม่ใช่วันหยุดราชการ',
            'date' => '2000-01-16',
            ],
            [
            'id' => 27,
            'name' => 'วันแรงงานแห่งชาติ',
            'type' => 'ไม่ใช่วันหยุดราชการ',
            'date' => '2000-05-01',
            ],
            [
            'id' => 28,
            'name' => 'วันสุนทรภู่',
            'type' => 'ไม่ใช่วันหยุดราชการ',
            'date' => '2000-06-26',
            ],
            [
            'id' => 29,
            'name' => 'วันลอยกระทง',
            'type' => 'ไม่ใช่วันหยุดราชการ',
            'date' => '1000-01-01',
            ],
            [
            'id' => 30,
            'name' => 'วันประชาธิปไตย',
            'type' => 'ไม่ใช่วันหยุดราชการ',
            'date' => '2000-10-14',
            ],
            [
            'id' => 31,
            'name' => 'วันวิทยาศาสตร์แห่งชาติ',
            'type' => 'ไม่ใช่วันหยุดราชการ',
            'date' => '2000-08-18',
            ],
        ]);
    }
}
