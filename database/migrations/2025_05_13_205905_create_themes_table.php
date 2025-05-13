public function up()
{
    Schema::create('themes', function (Blueprint $table) {
        $table->id();
        $table->string('nom')->unique();
        $table->timestamps();
    });
}
