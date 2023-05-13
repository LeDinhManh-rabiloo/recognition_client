<?php

use Illuminate\Database\Seeder as BaseSeeder;
use Illuminate\Support\Facades\DB;

abstract class Seeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();

            $this->process();

            DB::commit();

            $this->command->info(sprintf('Seeded class "%s" successfully.', get_class($this)));
        } catch (\Exception $exception) {
            DB::rollback();

            $this->command->error($exception->getMessage());
            $this->command->info($exception->getTraceAsString());
        }
    }

    /**
     * @return void
     */
    abstract protected function process();
}
