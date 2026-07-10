import React, { useState } from 'react';

const IntegrasiSistemPage = () => {
  const [integrations, setIntegrations] = useState([
    {
      id: 'whatsapp',
      name: 'WhatsApp API',
      description: 'Notifikasi pesan untuk pendaftaran PPDB, info pembayaran, dan pengumuman sekolah.',
      icon: '💬',
      status: 'Terhubung',
      color: 'emerald',
      lastSync: '10 menit yang lalu',
      config: { token: 'wa_token_xxx', phone: '+628123456789' }
    },
    {
      id: 'google',
      name: 'Google Workspace',
      description: 'Integrasi dengan Google Drive untuk penyimpanan dokumen siswa dan Google Meet untuk e-learning.',
      icon: '☁️',
      status: 'Tidak Terhubung',
      color: 'blue',
      lastSync: '-',
      config: { clientId: '', clientSecret: '' }
    },
    {
      id: 'payment',
      name: 'Payment Gateway (Midtrans)',
      description: 'Terima pembayaran SPP dan biaya pendaftaran secara online dengan virtual account.',
      icon: '💳',
      status: 'Terhubung',
      color: 'indigo',
      lastSync: '1 jam yang lalu',
      config: { serverKey: 'mid_server_xxx', clientKey: 'mid_client_xxx' }
    }
  ]);

  const [showConfigModal, setShowConfigModal] = useState(false);
  const [selectedIntegration, setSelectedIntegration] = useState(null);

  const handleConfigClick = (integration) => {
    setSelectedIntegration(integration);
    setShowConfigModal(true);
  };

  const handleToggleStatus = (id) => {
    setIntegrations(integrations.map(int => {
      if (int.id === id) {
        return {
          ...int,
          status: int.status === 'Terhubung' ? 'Tidak Terhubung' : 'Terhubung',
          lastSync: int.status === 'Terhubung' ? '-' : 'Baru saja'
        };
      }
      return int;
    }));
  };

  const getStatusStyle = (status, color) => {
    if (status === 'Terhubung') {
      return `bg-${color}-100 text-${color}-700 border-${color}-200`;
    }
    return 'bg-slate-100 text-slate-500 border-slate-200';
  };

  return (
    <div className="p-4 lg:p-8 space-y-6">
      <div className="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        {/* Header */}
        <div className="p-6 border-b border-slate-50 flex flex-col md:flex-row gap-6 justify-between items-start md:items-center">
          <div>
            <h2 className="text-lg font-bold text-slate-800">Integrasi Sistem (API)</h2>
            <p className="text-xs text-slate-400 mt-0.5">Kelola koneksi aplikasi dengan layanan pihak ketiga</p>
          </div>
          <button className="px-5 py-2.5 rounded-xl text-sm font-bold bg-slate-100 hover:bg-slate-200 text-slate-600 transition-all flex items-center gap-2">
            🔄 Sinkronisasi Semua
          </button>
        </div>

        {/* Integration List */}
        <div className="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {integrations.map(int => (
            <div key={int.id} className="border border-slate-200 rounded-2xl p-6 flex flex-col hover:shadow-md transition-shadow bg-slate-50/30">
              <div className="flex justify-between items-start mb-4">
                <div className={`w-12 h-12 rounded-xl flex items-center justify-center text-2xl shadow-sm bg-white border border-slate-100`}>
                  {int.icon}
                </div>
                <span className={`px-2.5 py-1 rounded-full text-[10px] font-bold border ${getStatusStyle(int.status, int.color)} flex items-center gap-1.5`}>
                  {int.status === 'Terhubung' && <span className={`w-1.5 h-1.5 rounded-full bg-${int.color}-500 animate-pulse`}></span>}
                  {int.status}
                </span>
              </div>
              
              <h3 className="font-bold text-slate-800 text-lg mb-2">{int.name}</h3>
              <p className="text-xs text-slate-500 mb-6 flex-1 leading-relaxed">{int.description}</p>
              
              <div className="text-[10px] text-slate-400 mb-4 font-mono">
                Terakhir Sinkronisasi: {int.lastSync}
              </div>
              
              <div className="flex gap-2 mt-auto">
                <button
                  onClick={() => handleToggleStatus(int.id)}
                  className={`flex-1 py-2 rounded-xl text-xs font-bold transition-all ${
                    int.status === 'Terhubung'
                      ? 'bg-rose-50 text-rose-600 hover:bg-rose-100'
                      : `bg-${int.color}-600 text-white hover:bg-${int.color}-700 shadow-sm shadow-${int.color}-500/30`
                  }`}
                >
                  {int.status === 'Terhubung' ? 'Putuskan' : 'Hubungkan'}
                </button>
                <button
                  onClick={() => handleConfigClick(int)}
                  className="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-xl text-xs font-bold transition-all"
                >
                  ⚙️
                </button>
              </div>
            </div>
          ))}
        </div>
      </div>

      {/* Modal Konfigurasi */}
      {showConfigModal && selectedIntegration && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
          <div className="bg-white rounded-[2rem] shadow-2xl w-full max-w-md overflow-hidden">
            <div className="p-6 border-b border-slate-100 flex justify-between items-center">
              <h3 className="text-lg font-bold text-slate-800 flex items-center gap-2">
                <span>{selectedIntegration.icon}</span> Konfigurasi {selectedIntegration.name}
              </h3>
              <button onClick={() => setShowConfigModal(false)} className="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500">✕</button>
            </div>
            <div className="p-6 space-y-4">
              <div className="p-4 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-600">
                Masukkan kredensial API yang Anda dapatkan dari dashboard {selectedIntegration.name}. Pastikan untuk merahasiakan kunci API Anda.
              </div>
              
              {Object.keys(selectedIntegration.config).map(key => (
                <div key={key}>
                  <label className="block text-xs font-bold text-slate-700 mb-1.5 capitalize">{key.replace(/([A-Z])/g, ' $1').trim()}</label>
                  <input
                    type="text"
                    defaultValue={selectedIntegration.config[key]}
                    className="w-full px-4 py-2.5 text-sm border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500/30 outline-none font-mono"
                    placeholder={`Masukkan ${key}...`}
                  />
                </div>
              ))}
            </div>
            <div className="p-6 border-t border-slate-100 flex justify-end gap-3">
              <button onClick={() => setShowConfigModal(false)} className="px-6 py-2.5 text-sm font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-all">Batal</button>
              <button onClick={() => setShowConfigModal(false)} className="px-6 py-2.5 text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition-all shadow-sm shadow-emerald-500/30">
                Simpan Kredensial
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default IntegrasiSistemPage;
