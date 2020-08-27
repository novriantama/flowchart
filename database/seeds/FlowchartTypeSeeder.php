<?php

use Illuminate\Database\Seeder;

class FlowchartTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('flowchart_type')->insert(array(
            array(
                'name' => 'Terminal',
            ),
            array(
                'name' => 'Process',
            ),
            array(
                'name' => 'Decision',
            ),
            array(
                'name' => 'Input/Output',
            ),
            array(
                'name' => 'Predefined Process',
            ),
            array(
                'name' => 'On-page Connector',
            )
        ));
    }
}
