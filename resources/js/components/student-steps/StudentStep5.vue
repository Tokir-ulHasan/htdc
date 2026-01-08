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
          <select 
            class="w-full border rounded px-3 py-2"
            :class="formErrors.presentAddressDist ? 'border-red-500' : 'border-gray-300'"
            :value="formData.presentAddressDist"
            @change="e => onChange('presentAddressDist', e.target.value)"
          >
            <option value="">Select District</option>
            <option value="Dhaka">Dhaka</option>
            <option value="Chittagong">Chittagong</option>
            <option value="Comilla">Comilla</option>
            <option value="Sylhet">Sylhet</option>
            <option value="Rajshahi">Rajshahi</option>
            <option value="Khulna">Khulna</option>
            <option value="Barisal">Barisal</option>
            <option value="Mymensingh">Mymensingh</option>
            <option value="Rangpur">Rangpur</option>
            <option value="Bogra">Bogra</option>
            <option value="Pabna">Pabna</option>
            <option value="Natore">Natore</option>
            <option value="Joypurhat">Joypurhat</option>
            <option value="Naogaon">Naogaon</option>
            <option value="Chapainawabganj">Chapainawabganj</option>
            <option value="Bagerhat">Bagerhat</option>
            <option value="Jhenaidah">Jhenaidah</option>
            <option value="Magura">Magura</option>
            <option value="Meherpur">Meherpur</option>
            <option value="Narail">Narail</option>
            <option value="Kushtia">Kushtia</option>
            <option value="Munshiganj">Munshiganj</option>
            <option value="Gazipur">Gazipur</option>
            <option value="Narsingdi">Narsingdi</option>
            <option value="Shariatpur">Shariatpur</option>
            <option value="Bandarban">Bandarban</option>
            <option value="Rangamati">Rangamati</option>
            <option value="Khagrachhari">Khagrachhari</option>
            <option value="Cox's Bazar">Cox's Bazar</option>
            <option value="Noakhali">Noakhali</option>
            <option value="Feni">Feni</option>
            <option value="Lakshmipur">Lakshmipur</option>
            <option value="Chandpur">Chandpur</option>
            <option value="Brahmanbaria">Brahmanbaria</option>
            <option value="Kishoreganj">Kishoreganj</option>
            <option value="Netrokona">Netrokona</option>
            <option value="Sherpur">Sherpur</option>
            <option value="Moulvibazar">Moulvibazar</option>
            <option value="Habiganj">Habiganj</option>
            <option value="Sunamganj">Sunamganj</option>
            <option value="Pirojpur">Pirojpur</option>
            <option value="Patuakhali">Patuakhali</option>
            <option value="Bhola">Bhola</option>
            <option value="Jhalokati">Jhalokati</option>
            <option value="Satkhira">Satkhira</option>
            <option value="Narayanganj">Narayanganj</option>
            <option value="Faridpur">Faridpur</option>
            <option value="Gopalganj">Gopalganj</option>
            <option value="Madaripur">Madaripur</option>
            <option value="Rajbari">Rajbari</option>
            <option value="Tangail">Tangail</option>
            <option value="Jamalpur">Jamalpur</option>
            <option value="Gaibandha">Gaibandha</option>
            <option value="Kurigram">Kurigram</option>
            <option value="Lalmonirhat">Lalmonirhat</option>
            <option value="Nilphamari">Nilphamari</option>
            <option value="Panchagarh">Panchagarh</option>
            <option value="Thakurgaon">Thakurgaon</option>
            <option value="Dinajpur">Dinajpur</option>
          </select>
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
          <select 
            class="w-full border rounded px-3 py-2"
            :class="formErrors.permanentAddressDist ? 'border-red-500' : 'border-gray-300'"
            :value="formData.permanentAddressDist"
            @change="e => onChange('permanentAddressDist', e.target.value)"
          >
            <option value="">Select District</option>
            <option value="Dhaka">Dhaka</option>
            <option value="Chittagong">Chittagong</option>
            <option value="Comilla">Comilla</option>
            <option value="Sylhet">Sylhet</option>
            <option value="Rajshahi">Rajshahi</option>
            <option value="Khulna">Khulna</option>
            <option value="Barisal">Barisal</option>
            <option value="Mymensingh">Mymensingh</option>
            <option value="Rangpur">Rangpur</option>
            <option value="Bogra">Bogra</option>
            <option value="Pabna">Pabna</option>
            <option value="Natore">Natore</option>
            <option value="Joypurhat">Joypurhat</option>
            <option value="Naogaon">Naogaon</option>
            <option value="Chapainawabganj">Chapainawabganj</option>
            <option value="Bagerhat">Bagerhat</option>
            <option value="Jhenaidah">Jhenaidah</option>
            <option value="Magura">Magura</option>
            <option value="Meherpur">Meherpur</option>
            <option value="Narail">Narail</option>
            <option value="Kushtia">Kushtia</option>
            <option value="Munshiganj">Munshiganj</option>
            <option value="Gazipur">Gazipur</option>
            <option value="Narsingdi">Narsingdi</option>
            <option value="Shariatpur">Shariatpur</option>
            <option value="Bandarban">Bandarban</option>
            <option value="Rangamati">Rangamati</option>
            <option value="Khagrachhari">Khagrachhari</option>
            <option value="Cox's Bazar">Cox's Bazar</option>
            <option value="Noakhali">Noakhali</option>
            <option value="Feni">Feni</option>
            <option value="Lakshmipur">Lakshmipur</option>
            <option value="Chandpur">Chandpur</option>
            <option value="Brahmanbaria">Brahmanbaria</option>
            <option value="Kishoreganj">Kishoreganj</option>
            <option value="Netrokona">Netrokona</option>
            <option value="Sherpur">Sherpur</option>
            <option value="Moulvibazar">Moulvibazar</option>
            <option value="Habiganj">Habiganj</option>
            <option value="Sunamganj">Sunamganj</option>
            <option value="Pirojpur">Pirojpur</option>
            <option value="Patuakhali">Patuakhali</option>
            <option value="Bhola">Bhola</option>
            <option value="Jhalokati">Jhalokati</option>
            <option value="Satkhira">Satkhira</option>
            <option value="Narayanganj">Narayanganj</option>
            <option value="Faridpur">Faridpur</option>
            <option value="Gopalganj">Gopalganj</option>
            <option value="Madaripur">Madaripur</option>
            <option value="Rajbari">Rajbari</option>
            <option value="Tangail">Tangail</option>
            <option value="Jamalpur">Jamalpur</option>
            <option value="Gaibandha">Gaibandha</option>
            <option value="Kurigram">Kurigram</option>
            <option value="Lalmonirhat">Lalmonirhat</option>
            <option value="Nilphamari">Nilphamari</option>
            <option value="Panchagarh">Panchagarh</option>
            <option value="Thakurgaon">Thakurgaon</option>
            <option value="Dinajpur">Dinajpur</option>
          </select>
          <p v-if="formErrors.permanentAddressDist" class="text-xs text-red-500 mt-1">{{ formErrors.permanentAddressDist }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
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

// Method to copy present address to permanent address
const copyPresentToPermanent = () => {
  props.onChange('permanentAddressVil', props.formData.presentAddressVil);
  props.onChange('permanentAddressPO', props.formData.presentAddressPO);
  props.onChange('permanentAddressPS', props.formData.presentAddressPS);
  props.onChange('permanentAddressDist', props.formData.presentAddressDist);
};
</script>