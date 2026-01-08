<template>
  <div class="bg-white p-4 rounded shadow">
    <h3 class="text-lg font-semibold mb-4">Student Applications</h3>
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead>
          <tr class="text-left">
            <th class="p-2 border">Name</th>
            <th class="p-2 border">Program</th>
            <th class="p-2 border">Session</th>
            <th class="p-2 border">Pin</th>
            <th class="p-2 border">Status</th>
            <th class="p-2 border">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="s in students" :key="s.id">
            <td class="p-2 border">{{ s.sNameEnglish }}</td>
            <td class="p-2 border">{{ s.program }}</td>
            <td class="p-2 border">{{ s.session }}</td>
            <td class="p-2 border">{{ s.pinCode }}</td>
            <td class="p-2 border">
              <span :class="s.status === 1 ? 'text-green-600' : 'text-yellow-600'">{{ s.status === 1 ? 'Complete' : 'Pending' }}</span>
            </td>
            <td class="p-2 border">
              <button @click="updateStatus(s.id, s.status === 1 ? 0 : 1)" class="px-3 py-1 bg-blue-600 text-white rounded">
                Toggle Status
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'StudentsAdmin',
  data() {
    return { students: [] };
  },
  mounted() {
    this.fetch();
  },
  methods: {
    async fetch() {
      const parts = window.location.pathname.split('/');
      const base = parts[1] ? `/${parts[1]}` : '';
      const apiBase = `${base}/api`;
      const res = await axios.get(`${apiBase}/admin/students`);
      this.students = res.data;
    },
    async updateStatus(id, status) {
      const parts = window.location.pathname.split('/');
      const base = parts[1] ? `/${parts[1]}` : '';
      const apiBase = `${base}/api`;
      await axios.put(`${apiBase}/admin/students/${id}`, { status });
      await this.fetch();
    }
  }
};
</script>
