public function up()
{
    Schema::table('seminaires', function (Blueprint $table) {
        $table->enum('statut', ['en_attente', 'validé', 'rejeté'])->default('en_attente');
    });
}
