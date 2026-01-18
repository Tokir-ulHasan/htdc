<template>
  <div class="space-y-6">
    <div class="bg-white p-4 rounded shadow">
      <h3 class="text-lg font-semibold mb-4">Upload Gallery Image</h3>
      <form @submit.prevent="upload" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <input v-model="form.title" type="text" class="border rounded px-3 py-2" placeholder="Title" />
        <input type="file" @change="onFile" accept="image/*" class="border rounded px-3 py-2" />
        <label class="flex items-center gap-2">
          <input type="checkbox" v-model="form.sliderStatus" />
          <span>Show in slider</span>
        </label>
        <input v-model="form.sliderTitle" type="text" class="border rounded px-3 py-2" placeholder="Slider Title" />
        <textarea v-model="form.sliderDescription" class="border rounded px-3 py-2 md:col-span-2" rows="3" placeholder="Slider Description"></textarea>
        <button class="bg-green-600 text-white px-4 py-2 rounded md:col-span-2">Upload</button>
      </form>
    </div>

    <div class="bg-white p-4 rounded shadow">
      <h3 class="text-lg font-semibold mb-4">Gallery Images</h3>
      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        <div v-for="g in items" :key="g.id" class="border rounded overflow-hidden">
          <img :src="computeImageUrl(g.path)" class="w-full h-40 object-cover" />
          <div class="p-2 text-sm">
            <div class="font-semibold">{{ g.title }}</div>
            <div class="flex gap-2 mt-2">
              <button @click="remove(g.id)" class="px-3 py-1 bg-red-600 text-white rounded">Delete</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'GalleryAdmin',
  data() {
    return {
      items: [],
      form: {
        title: '',
        image: null,
        sliderStatus: false,
        sliderTitle: '',
        sliderDescription: ''
      }
    };
  },
  mounted() {
    this.fetch();
  },
  methods: {
    async fetch() {
      const res = await axios.get('api/galleries');
      this.items = res.data;
    },
    onFile(e) {
      this.form.image = e.target.files[0] || null;
    },
    async upload() {
      const fd = new FormData();
      Object.entries(this.form).forEach(([k, v]) => {
        if (v !== null && v !== undefined) {
          fd.append(k, v);
        }
      });
      await axios.post('api/galleries', fd, { headers: { 'Content-Type': 'multipart/form-data' } });
      this.form = { title: '', image: null, sliderStatus: false, sliderTitle: '', sliderDescription: '' };
      await this.fetch();
    },
    async remove(id) {
      await axios.delete(`api/galleries/${id}`);
      await this.fetch();
    },
    computeImageUrl(path) {
      const p = String(path || '').replace(/^\/+/, '');
      try {
        return new URL(p, document.baseURI).href;
      } catch {
        const meta = document.querySelector('meta[name="base-url"]');
        const base = meta ? meta.getAttribute('content') || '' : '';
        const normalizedBase = base.replace(/\/+$/, '');
        return `${normalizedBase}/${p}`;
      }
    }
  }
};
</script>
