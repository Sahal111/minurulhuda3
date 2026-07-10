QUESTIONS = [
    # Student Management
    {"q": "What fields are required to create a new Siswa?", "exp": "app/Http/Controllers/Operator/SiswaController.php", "cat": "Student Management"},
    {"q": "How does the Siswa soft delete cascade work?", "exp": "app/Models/Siswa.php", "cat": "Student Management"},
    {"q": "Where are the student documents stored?", "exp": "ai_tools/memory_store.sqlite (Memory)", "cat": "Student Management"},
    {"q": "How are OrangTua related to Siswa?", "exp": "app/Models/Siswa.php", "cat": "Student Management"},
    # Class Management
    {"q": "Who manages the class schedules?", "exp": "app/Http/Controllers/Operator/KelasController.php", "cat": "Class Management"},
    {"q": "What is the relationship between Kelas and WaliKelas?", "exp": "app/Models/Kelas.php", "cat": "Class Management"},
    {"q": "How is the active Semester determined?", "exp": "app/Models/Semester.php", "cat": "Class Management"},
    {"q": "How does the PlotGuruMapel work?", "exp": "app/Models/PlotGuruMapel.php", "cat": "Class Management"},
    # Mutation Process
    {"q": "What are the valid mutation statuses for a student?", "exp": "app/Services/RiwayatKelasService.php", "cat": "Mutation Process"},
    {"q": "How does RiwayatKelasService handle a student mutating out?", "exp": "app/Services/RiwayatKelasService.php", "cat": "Mutation Process"},
    {"q": "What happens to the class history when a student graduates?", "exp": "app/Services/RiwayatKelasService.php", "cat": "Mutation Process"},
    # Promotion Process
    {"q": "How is a student promoted to the next grade?", "exp": "app/Services/RiwayatKelasService.php", "cat": "Promotion Process"},
    {"q": "Where is the status_kenaikan recorded?", "exp": "app/Models/Rapor.php", "cat": "Promotion Process"},
    {"q": "What happens if a student fails to promote (tinggal kelas)?", "exp": "app/Services/RiwayatKelasService.php", "cat": "Promotion Process"},
    # Models & Relationships
    {"q": "What models does Guru cascade to on soft delete?", "exp": "app/Models/Guru.php", "cat": "Models & Relationships"},
    {"q": "What is the primary key of the Pembayaran model?", "exp": "app/Models/Pembayaran.php", "cat": "Models & Relationships"},
    {"q": "How is the Role model related to the User model?", "exp": "app/Models/User.php", "cat": "Models & Relationships"},
    {"q": "Does the Rapor model have soft deletes?", "exp": "app/Models/Rapor.php", "cat": "Models & Relationships"},
    # Controllers
    {"q": "Which controller handles the creation of Guru?", "exp": "app/Http/Controllers/Operator/GuruController.php", "cat": "Controllers"},
    {"q": "What is the namespace of the AuthController?", "exp": "app/Http/Controllers/AuthController.php", "cat": "Controllers"},
    {"q": "Does GuruDiklatController extend Controller?", "exp": "app/Http/Controllers/Operator/GuruDiklatController.php", "cat": "Controllers"},
    {"q": "Which controller manages the academic years?", "exp": "app/Http/Controllers/Operator/TahunAjaranController.php", "cat": "Controllers"},
    # Routes
    {"q": "What middleware protects the operator routes?", "exp": "routes/web.php", "cat": "Routes"},
    {"q": "Are there any public routes available?", "exp": "routes/web.php", "cat": "Routes"},
    {"q": "What is the route prefix for the bendahara role?", "exp": "routes/web.php", "cat": "Routes"},
    {"q": "How are the PPDB routes protected?", "exp": "routes/web.php", "cat": "Routes"},
    # Database Migrations
    {"q": "How many migration files exist in the project?", "exp": "ai_tools/memory_store.sqlite (Memory)", "cat": "Database Migrations"},
    {"q": "Are there separate tables for guru_pendidikans and guru_sertifikasis?", "exp": "database/migrations", "cat": "Database Migrations"},
    {"q": "What columns are in the role_user pivot table?", "exp": "database/migrations", "cat": "Database Migrations"},
    {"q": "Is there a deleted_at column in the siswas table?", "exp": "database/migrations", "cat": "Database Migrations"}
]
