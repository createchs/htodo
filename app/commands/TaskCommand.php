<?php

class TaskCommand extends CConsoleCommand
{
    private function printCountAll()
    {
        Console::output("Task::count() = " . Task::model()->count());
        Console::output("ListOrder::count() = " . ListOrder::model()->count());
        Console::output("AttrLog::count() = " . AttrLog::model()->count());
        Console::output("ModelLog::count() = " . ModelLog::model()->count());
    }

    public function actionDeleteAll()
    {
        $this->printCountAll();

        Console::output("Deleting...");

        Task::model()->deleteAll();
        ListOrder::model()->deleteAll();
        AttrLog::model()->deleteAll();
        ModelLog::model()->deleteAll();

        $this->printCountAll();
    }

    public function actionCountAll()
    {
        $this->printCountAll();
    }
}