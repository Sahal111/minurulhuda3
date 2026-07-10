import React, { useState } from 'react';

const ImportPage = () => {
  const [selectedFile, setSelectedFile] = useState(null);
  const [importType, setImportType] = useState('siswa');
  const [isUploading, setIsUploading] = useState(false);
  const [uploadProgress, setUploadProgress] = useState(0);
  const [importResult, setImportResult] = useState(null);

  const handleFileChange = (e) => {
    if (e.target.files && e.target.files[0]) {
      setSelectedFile(e.target.files[0]);
    }
  };

  const handleImport = () => {
    if (!selectedFile) {
      alert('Pilih file Excel terlebih dahulu!');
      return;
    }
    
    setIsUploading(true);
    setUploadProgress(0);
    setImportResult(null);

    // Simulasi progress upload
    const interval = setInterval(() => {
      setUploadProgress(prev => {
        if (prev >= 100) {
          clearInterval(interval);
          setIsUploading(false);
          setImportResult({
            success: true,
            message: 'Import data berhasil dilakukan',
            details: {
              total: 125,
              berhasil: 120,
              gagal: 5
            }
          });
          setSelectedFile(null);
          return 100;
        }
        return prev + 20;
      });
    }, 500);
  };

  return (
    <div className="p-4 lg:p-8 space-y-6">
      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        {/* Header */}
        <div className="p-6 border-b border-slate-50">
          <h2 className="text-lg font-bold text-slate-800">Import Data Excel</h2>
          <p className="text-xs text-slate-400 mt-0.5">Import data massal dari file Excel (.xlsx, .xls) ke sistem</p>
        </div>

        <div className="p-6 grid grid-cols-1 lg:grid-cols-2 gap-8">
          {/* Form Import */}
          <div className="space-y-6">
            <div>
              <label className="block text-sm font-bold text-slate-700 mb-2">Jenis Data yang Diimport</label>
              <div className="grid grid-cols-2 gap-3">
                {[
                  { id: 'siswa', label: 'Data Siswa', icon: '👦' },
                  { id: 'guru', label: 'Data Guru', icon: '👨‍🏫' },
                  { id: 'ortu', label: 'Orang Tua / Wali', icon: '👨‍👩‍👦' },
                  { id: 'jadwal', label: 'Jadwal Pelajaran', icon: '📅' },
                ].map(type => (
                  <button
                    key={type.id}
                    onClick={() => setImportType(type.id)}
                    className={`p-4 rounded-2xl border-2 text-left transition-all ${
                      importType === type.id
                        ? 'border-emerald-500 bg-emerald-50/50 shadow-sm shadow-emerald-500/20'
                        : 'border-slate-100 bg-white hover:border-emerald-200'
                    }`}
                  >
                    <div className="text-2xl mb-2">{type.icon}</div>
                    <div className={`font-bold text-sm ${importType === type.id ? 'text-emerald-700' : 'text-slate-700'}`}>{type.label}</div>
                  </button>
                ))}
              </div>
            </div>

            <div>
              <label className="block text-sm font-bold text-slate-700 mb-2">Upload File Excel</label>
              <div className="border-2 border-dashed border-slate-300 rounded-2xl p-8 text-center bg-slate-50 hover:bg-slate-100 transition-colors cursor-pointer relative">
                <input
                  type="file"
                  accept=".xlsx, .xls"
                  onChange={handleFileChange}
                  className="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                />
                <div className="text-4xl mb-3">📄</div>
                {selectedFile ? (
                  <div>
                    <p className="text-sm font-bold text-emerald-600 mb-1">{selectedFile.name}</p>
                    <p className="text-[10px] text-slate-500">{(selectedFile.size / 1024).toFixed(2)} KB</p>
                  </div>
                ) : (
                  <div>
                    <p className="text-sm font-bold text-slate-600 mb-1">Klik atau seret file Excel ke sini</p>
                    <p className="text-xs text-slate-400">Format yang didukung: .xlsx, .xls (Maks. 5MB)</p>
                  </div>
                )}
              </div>
            </div>

            {isUploading && (
              <div className="space-y-2">
                <div className="flex justify-between text-xs font-bold text-emerald-700">
                  <span>Mengupload dan memproses...</span>
                  <span>{uploadProgress}%</span>
                </div>
                <div className="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                  <div className="bg-emerald-500 h-2.5 rounded-full transition-all duration-300" style={{ width: `${uploadProgress}%` }}></div>
                </div>
              </div>
            )}

            <button
              onClick={handleImport}
              disabled={isUploading || !selectedFile}
              className={`w-full py-4 rounded-xl font-bold text-sm transition-all shadow-sm ${
                isUploading || !selectedFile
                  ? 'bg-slate-200 text-slate-400 cursor-not-allowed'
                  : 'bg-emerald-600 hover:bg-emerald-700 text-white shadow-emerald-500/30'
              }`}
            >
              {isUploading ? 'Proses Import...' : 'Mulai Import Data'}
            </button>
            
            {importResult && (
              <div className={`p-4 rounded-xl border ${importResult.success ? 'bg-emerald-50 border-emerald-200' : 'bg-rose-50 border-rose-200'}`}>
                <div className="flex gap-3">
                  <div className="text-xl">{importResult.success ? '✅' : '❌'}</div>
                  <div>
                    <h4 className={`text-sm font-bold ${importResult.success ? 'text-emerald-800' : 'text-rose-800'}`}>{importResult.message}</h4>
                    {importResult.details && (
                      <ul className={`mt-2 text-xs space-y-1 ${importResult.success ? 'text-emerald-700' : 'text-rose-700'}`}>
                        <li>Total Data: {importResult.details.total} baris</li>
                        <li>Berhasil: <strong>{importResult.details.berhasil}</strong></li>
                        {importResult.details.gagal > 0 && <li>Gagal: <strong className="text-rose-600">{importResult.details.gagal}</strong> (Cek file log untuk detail)</li>}
                      </ul>
                    )}
                  </div>
                </div>
              </div>
            )}
          </div>

          {/* Panduan & Template */}
          <div className="bg-slate-50 p-6 rounded-2xl border border-slate-100 space-y-6">
            <div>
              <h3 className="text-sm font-bold text-slate-800 mb-2 flex items-center gap-2">
                <span>📝</span> Panduan Import
              </h3>
              <ul className="text-xs text-slate-600 space-y-2 list-disc list-inside">
                <li>Pastikan file yang diupload menggunakan template yang telah disediakan.</li>
                <li>Jangan mengubah struktur kolom pada file template.</li>
                <li>Baris pertama (header) tidak akan diimport.</li>
                <li>Pastikan format tanggal menggunakan <code className="bg-slate-200 px-1 rounded">YYYY-MM-DD</code>.</li>
                <li>Maksimal baris data per file adalah 1000 baris untuk menjaga performa.</li>
              </ul>
            </div>
            
            <hr className="border-slate-200" />
            
            <div>
              <h3 className="text-sm font-bold text-slate-800 mb-4 flex items-center gap-2">
                <span>📥</span> Download Template Excel
              </h3>
              <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
                {[
                  { name: 'Template Data Siswa', type: 'siswa' },
                  { name: 'Template Data Guru', type: 'guru' },
                  { name: 'Template Orang Tua', type: 'ortu' },
                  { name: 'Template Jadwal', type: 'jadwal' },
                ].map(tmpl => (
                  <button key={tmpl.type} className="flex items-center justify-between p-3 bg-white border border-slate-200 rounded-xl hover:border-emerald-500 hover:shadow-sm transition-all group text-left">
                    <span className="text-xs font-bold text-slate-700 group-hover:text-emerald-700">{tmpl.name}</span>
                    <span className="text-slate-400 group-hover:text-emerald-600">↓</span>
                  </button>
                ))}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ImportPage;
