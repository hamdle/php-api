<?php
namespace Models;

class Workout
{
    use \Utils\Attributes;
    /**
     * The Workout attributes defined by the database are:
     *
     * id
     * user_id
     * start
     * end
     * notes
     * feel (weak, good, strong)
     *
     */

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    public function html()
    {
        $html = <<<EOT
<ul>
    <li>Warm ups</li>
    <li>Pull ups</li>
    <li>Chin ups</li>
    <li>Push ups</li>
    <li>Pistols</li>
    <li>Dips</li>
    <li>Leg raises</li>
    <li>Cobraz</li>
</ul>
EOT;

        return $html;
    }
}
