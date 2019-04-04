<?php

namespace Vendor_Andrey;

srand ((double) microtime()*1000000);

class Rectangle
{
    public $Side_A;
	public $Side_B;
    function __construct()
    {
        $this->Side_A = rand(1, 20);
        $this->Side_B = rand(1, 20);

        //echo $this->Side_A."\n".$this->Side_B."\n";
    }
//Нахождение Площади прямоугольника
	public function Area()
    {
        return $this->Side_A * $this->Side_B;
    }
}

class Circle
{
    public $PI;
    public $radius;
    function __construct()
    {
        $this->PI = 3.14;
        $this->radius = rand(1, 20);
    }
//Нахождение Площади круга
    public function Area()
	{
        return $this->PI * $this->radius;
    }
}

class Pyramid extends Rectangle
{
    public $Side_C;
    function __construct()
    {
        parent::__construct();//Конструктор родительского класса
        $this->Side_C = rand(1, 20);
        //echo $this->Side_C."\n";
    }
    //Нахождение Половины периметра одной стороны пирамиды согласно формулы р = (a+b+c)/2
    //где р - полупериметр, а b c - стороны пирамиды, где b = c так как с прилегающая к вершине сторона
    public function Half_P()
    {
        return ($this->Side_A+ $this->Side_C*2)/2;
    }
    //Промежуточная функция для определения апофемы пирамиды (р(р-а)(р-b)(p-c), где а - основание,
    // b = c(равные стороны), с - сторона прилегающая к вершине,
    public function TempApofem()
    {
        return $this->Half_P()*
            ($this->Half_P()-$this->Side_A)*
            ($this->Half_P()-$this->Side_C)*
            ($this->Half_P()-$this->Side_C);
    }
    //Поиск апофемы пирамиды по формуле 2\а*корень_из_(р(р-а)(р-b)(p-c), где а - основание,
    // b = c(равные стороны), с - сторона прилегающая к вершине, р - полупериметр Р()
    public function ApofemaOfPyramid()
    {
        if ($this->TempApofem()<0) {
            return 0;
        } else {
            return sqrt($this->TempApofem())*2/$this->Side_A;
        }
    }
    //Периметр основания пирамиды 2(A+B)
    public function PerOfBase()
    {
        return ($this->Side_A + $this->Side_B)*2;
    }
    //Площадь пирамиды 1\2рL+площадь_основания, где L - апофема
    public function AreaPyramid()
    {
        if ($this->ApofemaOfPyramid()== 0) {
            return 0;
        } else {
            return 1/2*$this->PerOfBase()*$this->ApofemaOfPyramid()+Rectangle::Area();
        }
    }
}

$OpenFile = fopen("My_Shapes.txt", "w");

for ($i=0; $i<5; $i++) {
    $A = new Rectangle();
    $TextA = "Created new Rectangle!<br>Side A = "
        .$A->Side_A."<br>Side B = "
        .$A->Side_B."<br>Area = "
        .$A->Area()."<br><br>";
    $B = new Circle();
    $TextB = "Created new Circle!<br>radius = ".$B->radius."<br>Area = ".$B->Area()."<br><br>";
    $C = new Pyramid();
    $TextC = "Created new Pyramid!<br>Side A = "
        .$C->Side_A."<br>Side B = "
        .$C->Side_B."<br>Side C = "
        .$C->Side_C."<br>Area = "
        .$C->AreaPyramid()."<br><br>";
    echo $TextA, $TextB, $TextC;
    fwrite($OpenFile, $TextA);
    fwrite($OpenFile, $TextB);
    fwrite($OpenFile, $TextC);
}
fclose($OpenFile);

?>