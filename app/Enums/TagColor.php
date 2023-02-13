<?php

namespace App\Enums;

enum TagColor
{
    case DarkBlue;
    case Blue;
    case Indigo;
    case Purple;
    case Pink;
    case Red;
    case Orange;
    case Yellow;
    case DarkYellow;
    case Green;
    case Teal;
    case Cyan;

    public function color(): string
    {
        return match($this) 
        {
            TagColor::DarkBlue => 'dark-blue',
            TagColor::Blue => 'blue',
            TagColor::Indigo => 'indigo',
            TagColor::Purple => 'purple',
            TagColor::Pink => 'pink',
            TagColor::Red => 'red',
            TagColor::Orange => 'orange',
            TagColor::Yellow => 'yellow',
            TagColor::DarkYellow => 'dark-yellow',
            TagColor::Green => 'green',
            TagColor::Teal => 'teal',
            TagColor::Cyan => 'cyan',
        };
    }

    static public function getValues(): array
    {
        return [
            TagColor::DarkBlue,
            TagColor::Blue,
            TagColor::Indigo,
            TagColor::Purple,
            TagColor::Pink,
            TagColor::Red,
            TagColor::Orange,
            TagColor::Yellow,
            TagColor::DarkYellow,
            TagColor::Green,
            TagColor::Teal,
            TagColor::Cyan,
        ];
    }

    public function getRandomValue(): string
    {
        $colors = TagColor::getValues();
        return $colors[array_rand($colors)];
    }
}
