<?php

/*
Classes:
1. Описують сутність у загальному вигляді
2. Повинен описувати одну і тільки одну сутність
3. Якщо за допомогою класс уне можемо створити корректний об'єкт - то це по рушує умови классу

Об'єкт:
1. Повинен логічно існувати у реальному житі
2.

Конструктор:
1. Конструктор - створює об'єкт
2. Ціль: Створити корректний об'єкт
*/

abstract class Shape {
    public abstract function square();
}

class Rectangle extends Shape {
    private $width;
    private $height;

    public function __construct($width, $height)
    {
        if((int)$width <= 0 || (int)$height <= 0) {
            throw new Exception("Fail");
        }

        $this->width = $width;
        $this->height = $height;
    }

    public function square() {
        return $this->width * $this->height;
    }
}

class Circle extends Shape {
    private $radius;

    public function __construct($radius)
    {
        $this->radius = $radius;
    }

    public function square() {
        return M_PI * ($this->radius * $this->radius);
    }
}

function getMinFigure(Shape $shape1, Shape $shape2) {
    if($shape1->square() < $shape2->square()) {
        return $shape1;
    }

    return $shape2;
}

$shape = getMinFigure(new Circle(10), new Rectangle(2, 4));
var_dump($shape);
