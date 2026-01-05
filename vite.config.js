import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import { rm } from 'node:fs/promises'
import { fileURLToPath, URL } from "url";
// import vuetify from 'vite-plugin-vuetify'

export default defineConfig({
    define: {
        __VUE_PROD_DEVTOOLS__: true,
      },
    plugins: [vue(),
      // vuetify({styles: {configFile: 'src/styles/customsettings.scss'}}),
        {
            name: "Cleaning assets folder",
            async buildStart() {
              await rm('public/assets', { recursive: true, force: true });
            }
        }
    ],
    resolve: { 
      alias:  [
        {
          find: '@', replacement: fileURLToPath(new URL('./src', import.meta.url))
        }
      ]
    },
    build: {
        rollupOptions: {
            input: {
                app: 'src/main.js',
              }
        },
        commonjsOptions: {
            strictRequires: true
          },
        outDir: './public',
        copyPublicDir: false,
        emptyOutDir: false
    }
});
