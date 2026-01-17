<template>
  <div class="space-y-6">
    <!-- Present Address -->
    <div class="border p-4 rounded relative">
      <div class="absolute -top-3 left-3 bg-white px-2 text-sm font-bold text-green-700">Present Address</div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Village/Block/Area <span class="text-red-500">*</span></label>
          <input 
            type="text" 
            class="w-full border rounded px-3 py-2"
            :class="formErrors.presentAddressVil ? 'border-red-500' : 'border-gray-300'"
            :value="formData.presentAddressVil"
            @input="e => onChange('presentAddressVil', e.target.value)"
          />
          <p v-if="formErrors.presentAddressVil" class="text-xs text-red-500 mt-1">{{ formErrors.presentAddressVil }}</p>
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Post Office <span class="text-red-500">*</span></label>
          <input 
            type="text" 
            class="w-full border rounded px-3 py-2"
            :class="formErrors.presentAddressPO ? 'border-red-500' : 'border-gray-300'"
            :value="formData.presentAddressPO"
            @input="e => onChange('presentAddressPO', e.target.value)"
          />
          <p v-if="formErrors.presentAddressPO" class="text-xs text-red-500 mt-1">{{ formErrors.presentAddressPO }}</p>
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Police Station <span class="text-red-500">*</span></label>
          <input 
            type="text" 
            class="w-full border rounded px-3 py-2"
            :class="formErrors.presentAddressPS ? 'border-red-500' : 'border-gray-300'"
            :value="formData.presentAddressPS"
            @input="e => onChange('presentAddressPS', e.target.value)"
          />
          <p v-if="formErrors.presentAddressPS" class="text-xs text-red-500 mt-1">{{ formErrors.presentAddressPS }}</p>
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">District <span class="text-red-500">*</span></label>
          <CustomSelect
            :model-value="formData.presentAddressDist"
            :options="districtOptions"
            :placeholder="'Select District'"
            :error="!!formErrors.presentAddressDist"
            @update:modelValue="v => onChange('presentAddressDist', v)"
          />
          <p v-if="formErrors.presentAddressDist" class="text-xs text-red-500 mt-1">{{ formErrors.presentAddressDist }}</p>
        </div>
      </div>
    </div>

    <!-- Copy to Permanent Address Button -->
    <div class="flex justify-left">
      <button
        type="button"
        @click="copyPresentToPermanent"
        class="px-4 py-2 bg-green-600 text-white rounded font-medium hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
      >
        Same as Permanent Address
      </button>
    </div>

    <!-- Permanent Address -->
    <div class="border p-4 rounded relative">
      <div class="absolute -top-3 left-3 bg-white px-2 text-sm font-bold text-green-700">Permanent Address</div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Village/Block/Area <span class="text-red-500">*</span></label>
          <input 
            type="text" 
            class="w-full border rounded px-3 py-2"
            :class="formErrors.permanentAddressVil ? 'border-red-500' : 'border-gray-300'"
            :value="formData.permanentAddressVil"
            @input="e => onChange('permanentAddressVil', e.target.value)"
          />
          <p v-if="formErrors.permanentAddressVil" class="text-xs text-red-500 mt-1">{{ formErrors.permanentAddressVil }}</p>
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Post Office <span class="text-red-500">*</span></label>
          <input 
            type="text" 
            class="w-full border rounded px-3 py-2"
            :class="formErrors.permanentAddressPO ? 'border-red-500' : 'border-gray-300'"
            :value="formData.permanentAddressPO"
            @input="e => onChange('permanentAddressPO', e.target.value)"
          />
          <p v-if="formErrors.permanentAddressPO" class="text-xs text-red-500 mt-1">{{ formErrors.permanentAddressPO }}</p>
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Police Station <span class="text-red-500">*</span></label>
          <input 
            type="text" 
            class="w-full border rounded px-3 py-2"
            :class="formErrors.permanentAddressPS ? 'border-red-500' : 'border-gray-300'"
            :value="formData.permanentAddressPS"
            @input="e => onChange('permanentAddressPS', e.target.value)"
          />
          <p v-if="formErrors.permanentAddressPS" class="text-xs text-red-500 mt-1">{{ formErrors.permanentAddressPS }}</p>
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">District <span class="text-red-500">*</span></label>
          <CustomSelect
            :model-value="formData.permanentAddressDist"
            :options="districtOptions"
            :placeholder="'Select District'"
            :error="!!formErrors.permanentAddressDist"
            @update:modelValue="v => onChange('permanentAddressDist', v)"
          />
          <p v-if="formErrors.permanentAddressDist" class="text-xs text-red-500 mt-1">{{ formErrors.permanentAddressDist }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import CustomSelect from '../common/CustomSelect.vue';
// Props
const props = defineProps({
  formData: {
    type: Object,
    required: true
  },
  formErrors: {
    type: Object,
    required: true
  },
  onChange: {
    type: Function,
    required: true
  },
  stepNumber: {
    type: Number,
    required: true
  }
});

const districtOptions = [
  "Dhaka","Chittagong","Comilla","Sylhet","Rajshahi","Khulna","Barisal","Mymensingh","Rangpur","Bogra","Pabna","Natore","Joypurhat","Naogaon","Chapainawabganj","Bagerhat","Jhenaidah","Magura","Meherpur","Narail","Kushtia","Munshiganj","Gazipur","Narsingdi","Shariatpur","Bandarban","Rangamati","Khagrachhari","Cox's Bazar","Noakhali","Feni","Lakshmipur","Chandpur","Brahmanbaria","Kishoreganj","Netrokona","Sherpur","Moulvibazar","Habiganj","Sunamganj","Pirojpur","Patuakhali","Bhola","Jhalokati","Satkhira","Narayanganj","Faridpur","Gopalganj","Madaripur","Rajbari","Tangail","Jamalpur","Gaibandha","Kurigram","Lalmonirhat","Nilphamari","Panchagarh","Thakurgaon","Dinajpur"
];

// Method to copy present address to permanent address
const copyPresentToPermanent = () => {
  props.onChange('permanentAddressVil', props.formData.presentAddressVil);
  props.onChange('permanentAddressPO', props.formData.presentAddressPO);
  props.onChange('permanentAddressPS', props.formData.presentAddressPS);
  props.onChange('permanentAddressDist', props.formData.presentAddressDist);
};
</script>
