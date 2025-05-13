public function up()
{
    Schema::create('presentateurs', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->string('email')->unique();
        $table->enum('statut', ['en_attente', 'validé'])->default('en_attente');
        $table->timestamps();
    });
}
