<template>
  <div class="space-y-6">
    <div class="bg-white p-4 rounded shadow">
      <h3 class="text-lg font-semibold mb-4">Create Notice</h3>
      <form @submit.prevent="createNotice" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <input v-model="form.title" type="text" class="border rounded px-3 py-2" placeholder="Title" required />
        <input v-model="form.category" type="text" class="border rounded px-3 py-2" placeholder="Category" />
        <input v-model="form.date" type="date" class="border rounded px-3 py-2" />
        <input v-model="form.audience" type="text" class="border rounded px-3 py-2" placeholder="Audience" />
        <input v-model="form.version" type="text" class="border rounded px-3 py-2" placeholder="Version" />
        <input @change="onFileChange" type="file" accept="image/*" class="border rounded px-3 py-2" />
        <textarea v-model="form.description" class="border rounded px-3 py-2 md:col-span-2" rows="4" placeholder="Description"></textarea>
        <button class="bg-green-600 text-white px-4 py-2 rounded md:col-span-2">Create Notice</button>
      </form>
    </div>

    <div class="bg-white p-4 rounded shadow">
      <h3 class="text-lg font-semibold mb-4">Notices</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div v-for="n in notices" :key="n.id" class="border rounded overflow-hidden">
          <img v-if="n.image_path" :src="computeImageUrl(n.image_path)" class="w-full h-40 object-cover" />
          <div class="p-3">
            <div class="font-semibold">{{ n.title }}</div>
            <div class="text-sm text-gray-600">{{ n.category }}</div>
            <div class="text-xs text-gray-500">{{ n.date }}</div>
            <p class="text-sm mt-2">{{ n.description }}</p>
            <div class="flex gap-2 mt-3">
              <button @click="remove(n.id)" class="px-3 py-1 bg-red-600 text-white rounded">Delete</button>
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
  name: 'NoticesAdmin',
  data() {
    return {
      notices: [],
      form: {
        title: '',
        category: '',
        description: '',
        date: '',
        audience: '',
        version: '',
        image: null
      }
    };
  },
  mounted() {
    this.fetchNotices();
  },
  methods: {
    async fetchNotices() {
      const base = (window.location.pathname.split('/')[1] ? `/${window.location.pathname.split('/')[1]}` : '');
      const res = await axios.get(`${base}/api/notices`);
      this.notices = res.data;
    },
    onFileChange(e) {
      this.form.image = e.target.files[0] || null;
    },
    async createNotice() {
      const fd = new FormData();
      Object.entries(this.form).forEach(([k, v]) => {
        if (v !== null && v !== undefined && v !== '') {
          fd.append(k, v);
        }
      });
      const base = (window.location.pathname.split('/')[1] ? `/${window.location.pathname.split('/')[1]}` : '');
      await axios.post(`${base}/api/notices`, fd, { headers: { 'Content-Type': 'multipart/form-data' } });
      this.form = { title: '', category: '', description: '', date: '', audience: '', version: '', image: null };
      await this.fetchNotices();
    },
    async remove(id) {
      const base = (window.location.pathname.split('/')[1] ? `/${window.location.pathname.split('/')[1]}` : '');
      await axios.delete(`${base}/api/notices/${id}`);
      await this.fetchNotices();
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
