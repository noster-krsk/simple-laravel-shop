// vite.local.js
import vue from '@vitejs/plugin-vue';

export default {
  server: {
    host: '0.0.0.0',
    port: 5173,
    strictPort: true,
    hmr: {
      host: '10.255.255.254',  // ← IP из /etc/resolv.conf
      port: 5173,
      protocol: 'ws',
    },
  },
  plugins: [vue()],
};
