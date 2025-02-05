<?php

namespace Database\Seeders\Shared;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();
        try {
            //Remove Old Data
            DB::table('configs')->truncate();

            //Data Preparation
            $data = [
                [
                    "name" => "SiteTitle",
                    "description" => "A short title for the website",
                    "value" => env("APP_NAME", "Website-API")
                ],
                [
                    "name" => "SiteDescription",
                    "description" => "A short description about the website",
                    "value" => "Website Description"
                ],
                [
                    "name" => "SiteURL",
                    "description" => "Root Domain URL",
                    "value" => "https://website.com"
                ],
                [
                    "name" => "AppURL",
                    "description" => "Root Panel URL",
                    "value" => env('FRONT_URL', 'localhost:3000')
                ],
                [
                    "name" => "SiteBlog",
                    "description" => "Blog Domain",
                    "value" => "https://insights.oxo.com"
                ],
                [
                    "name" => "SiteEmail",
                    "description" => "A contact mail",
                    "value" => env("MAIL_FROM_ADDRESS", "postman@oxo.com")
                ]
            ];

            DB::table('configs')->insert($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
