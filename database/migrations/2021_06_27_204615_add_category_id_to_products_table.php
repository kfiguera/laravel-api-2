<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $category = new \App\Models\Category();
        $category->name = 'Otros';
        $category->save();

        Schema::table('products', function (Blueprint $table) use($category) {
            $table->unsignedBigInteger('category_id')->default($category->id)->after('price');
            $table->foreign('categori_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('category_id');
            $table->dropColumn('category_id');
        });
    }
}
