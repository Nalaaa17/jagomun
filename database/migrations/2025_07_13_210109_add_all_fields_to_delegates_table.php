    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::table('delegates', function (Blueprint $table) {
                // Hapus kolom lama yang tidak sesuai lagi jika ada
                // $table->dropColumn(['do_you_need_accommodation', 'social_media_upload']);

                // Tambahkan kolom personal info baru setelah 'phone'
                $table->date('date_of_birth')->nullable()->after('phone');
                $table->integer('age')->nullable()->after('date_of_birth');
                $table->string('gender')->nullable()->after('age');
                $table->text('full_address')->nullable()->after('gender');

                // Tambahkan kolom pengalaman setelah 'package_type'
                $table->text('previous_mun_experience')->nullable()->after('package_type');
                $table->text('mun_awards')->nullable()->after('previous_mun_experience');

                // Tambahkan kolom untuk path file dokumen
                $table->string('student_id_path')->nullable()->after('mun_awards');
                $table->string('parental_consent_path')->nullable()->after('student_id_path');
                $table->string('social_media_proof_path')->nullable()->after('parental_consent_path');
                $table->string('partnership_code')->nullable()->after('social_media_proof_path');

                // Tambahkan kolom konfirmasi
                $table->boolean('info_confirmation')->default(false)->after('partnership_code');
                $table->boolean('data_usage_agreement')->default(false)->after('info_confirmation');

                // Ganti nama kolom alasan agar lebih sesuai
                $table->renameColumn('reason_for_first_country_preference_1', 'reason_for_council_preference_1');
                $table->renameColumn('reason_for_second_country_preference_1', 'reason_for_council_preference_2');

                // Hapus kolom alasan yang tidak terpakai
                $table->dropColumn([
                    'reason_for_first_country_preference_2',
                    'reason_for_second_country_preference_2'
                ]);
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::table('delegates', function (Blueprint $table) {
                $table->dropColumn([
                    'date_of_birth', 'age', 'gender', 'full_address',
                    'previous_mun_experience', 'mun_awards', 'student_id_path',
                    'parental_consent_path', 'social_media_proof_path', 'partnership_code',
                    'info_confirmation', 'data_usage_agreement'
                ]);

                $table->renameColumn('reason_for_council_preference_1', 'reason_for_first_country_preference_1');
                $table->renameColumn('reason_for_council_preference_2', 'reason_for_second_country_preference_1');

                $table->text('reason_for_first_country_preference_2')->nullable();
                $table->text('reason_for_second_country_preference_2')->nullable();
            });
        }
    };
