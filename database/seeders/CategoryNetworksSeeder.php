<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryNetworksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("
            INSERT INTO `category_networks` (`id`, `cat_id`, `network_name`, `network_icon`, `network_price`, `network_unlock_price`) VALUES
            (4, 7, 'AT&T', '420190825165654.png', '1', '2'),
            (6, 13, 'AT&T', '620190825165848.png', '2', '4'),
            (23, 13, 'Factory Unlocked', '2320190825165848.png', '3', '3'),
            (25, 13, 'Sprint', '2520190825165848.png', '2', '3'),
            (26, 13, 'T-Mobile', '2620190825165848.png', '2', '3'),
            (27, 13, 'Verizon', '2720190825165848.png', '2', '3'),
            (29, 7, 'Factory Unlocked', '2920190825165654.png', '3', '3'),
            (31, 7, 'Sprint', '3120190825165654.png', '0', '0'),
            (32, 7, 'T-Mobile', '3220190825165654.png', '0', '0'),
            (33, 7, 'Verizon', '3320190825165654.png', '0', '0'),
            (36, 13, 'Others', '2820190825165848.png', '0', '0'),
            (64, 17, 'AT&T', '', '0', '0'),
            (65, 17, 'Factory Unlocked', '', '0', '0'),
            (66, 17, 'Sprint', 'MjAyMjAyMjQxMzUxMDk=.png', '0', '0'),
            (67, 17, 'T-Mobile', '', '0', '0'),
            (68, 17, 'Verizon', 'MjAyMjAyMjQxMzUwMDk=.png', '0', '0'),
            (69, 17, 'Others', 'MjAyMjAyMjQxMzQ5MjY=.png', '0', '0'),
            (263, 78, 'xiaomi', 'MjAyMjAyMjQxNDMxNTY=.png', '0', '0'),
            (264, 78, 'Dell', 'MjAyMjAyMjQxNDMxNTY=.png', '0', '0'),
            (265, 83, 'dell', 'MjAyMjAyMjQxNDM2NTA=.png', '0', '0'),
            (266, 84, 'dell', 'MjAyMjAyMjQxNDM4Mzg=.png', '0', '0'),
            (267, 85, 'dell', 'MjAyMjAyMjQxNDQyMDU=.png', '0', '0'),
            (268, 13, 'AT&T', '620190825165848.png', '0', '0'),
            (269, 13, 'Factory Unlocked', '2320190825165848.png', '0', '0'),
            (270, 13, 'Sprint', '2520190825165848.png', '0', '0'),
            (271, 13, 'T-Mobile', '2620190825165848.png', '0', '0'),
            (272, 13, 'Verizon', '2720190825165848.png', '0', '0'),
            (273, 13, 'Others', '2820190825165848.png', '0', '0'),
            (274, 7, 'AT&T', '420190825165654.png', '0', '0'),
            (275, 7, 'Factory Unlocked', '2920190825165654.png', '0', '0'),
            (276, 7, 'Sprint', '3120190825165654.png', '0', '0'),
            (277, 7, 'T-Mobile', '3220190825165654.png', '0', '0'),
            (278, 7, 'Verizon', '3320190825165654.png', '0', '0'),
            (298, 86, 'xiaomi', 'MjAyMjAyMjQxNTE1MTQ=.png', '0', '0'),
            (299, 86, 'google', 'MjAyMjAyMjQyMDQxNDU=.png', '0', '0'),
            (301, 87, 'dfd', 'MjAyMjAyMjUyMzkxMg==.png', '0', '0'),
            (302, 88, 'TNT Adsd', 'MjAyMjAyMjUyNTkxMw==.png', '0', '0'),
            (303, 6, 'AT&T', 'MjAyMjAyMjU4NDAxMg==.png', '0', '0'),
            (304, 6, 'Factory Unlocked', 'MjAyMjAyMjU4NDAxMg==.png', '0', '0'),
            (305, 6, 'Sprint', 'MjAyMjAyMjU4NDAxMg==.png', '0', '0'),
            (306, 6, 'T-Mobile', 'MjAyMjAyMjU4NDAxMg==.png', '0', '0'),
            (307, 6, 'Verizon', 'MjAyMjAyMjU4NDAxMw==.png', '0', '0'),
            (308, 6, 'Others', 'MjAyMjAyMjU4NDAxMw==.png', '0', '0');
        ");
    }
}
