<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class TodoListTask extends Model
{
    use HasFactory;

    protected $table = 'todolist_tasks';
    protected $fillable = ['todo_list_id', 'text', 'due', 'completed'];

    /**
     * Get the task's status
     *
     * @param $value
     * @return string
     */
    public function getCompletedAttribute($value)
    {
        if($value == 0) {
            return 'Не выполнено';
        } else {
            return 'Выполнено';
        }
    }

    /**
     * Get the task's due date
     *
     * @param $value
     * @return string
     */
    public function getDueAttribute($value)
    {
        $timestamp = strtotime($value);
        $date_fields = getdate($timestamp);
        $months = [1 => 'Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря'];

        foreach($date_fields as $field) {
            foreach ($months as $month_key => $month) {
                if($date_fields['mon'] === $month_key) {
                    $date_fields['mon'] = $month;
                }
            }
        }

        $day = $date_fields['mday'];
        $month = $date_fields['mon'];

        return $day . ' ' . $month;
    }
}
