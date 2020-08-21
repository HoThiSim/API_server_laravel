<?php

use App\Product;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $f)
    {
        //
        for($i=0;$i<10;$i++){
            $p=new Product();
            $p->name=$f->name;
            $p->description=$f->text;
            $p->image='http://127.0.0.1:8000/storage/public/test.jpg';
            $p->price=random_int(10000,100000);
            $p->save();
        }
    }
}
