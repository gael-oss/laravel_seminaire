use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('seminaires', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->dateTime('date_presentation');
            $table->text('resume')->nullable();
            $table->string('fichier')->nullable();
            $table->foreignId('presentateur_id')->constrained()->onDelete('cascade');
            $table->foreignId('theme_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('seminaires');
    }
};
