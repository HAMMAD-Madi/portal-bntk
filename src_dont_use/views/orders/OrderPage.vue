<template>
  <v-container max-width="800" style="padding-bottom: 100px !important;">

    <v-card class="card z-index-2 h-100">
      <v-card-text class="card-body p-3">
        <v-empty-state v-if="!order.hasOwnProperty('order_id')" headline="Oops, 404" title="Order niet gevonden"
          :text="`De order met ordernummer '${order_id}' kon niet gevonden worden`"
          image="data:image/svg+xml,%3Csvg%20width%3D%2264%22%20height%3D%2264%22%20viewBox%3D%220%200%2064%2064%22%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%3E%3Ccircle%20cx%3D%2226%22%20cy%3D%2226%22%20r%3D%2216%22%20stroke%3D%22%23555%22%20stroke-width%3D%224%22%20fill%3D%22%23F3F4F6%22/%3E%3Cline%20x1%3D%2236%22%20y1%3D%2236%22%20x2%3D%2254%22%20y2%3D%2254%22%20stroke%3D%22%23555%22%20stroke-width%3D%224%22%20stroke-linecap%3D%22round%22/%3E%3Cpath%20d%3D%22M26%2020c1.9%200%203.4%201.5%203.4%203.4%200%201.4-0.9%202.5-2.3%202.8-0.8%200.3-1.1%201.2-1.1%202.1v1h-2v-1c0-1.6%200.8-3.1%202.3-3.6%200.6-0.2%201.1-0.7%201.1-1.3%200-0.9-0.7-1.6-1.6-1.6s-1.6%200.7-1.6%201.6h-2c0-1.9%201.5-3.4%203.4-3.4z%22%20fill%3D%22%23555%22/%3E%3Ccircle%20cx%3D%2226%22%20cy%3D%2232%22%20r%3D%221%22%20fill%3D%22%23555%22/%3E%3C/svg%3E" />
        <div v-else>
          <v-row>
            <v-col cols="12"><v-text-field label="Bedrijfsnaam" v-model="order.contact.shipping_company_name"
                variant="outlined"></v-text-field></v-col>
          </v-row>
          <v-row>
            <v-col cols="4"><v-text-field label="Voornaam" v-model="order.contact.shipping_firstname"
                variant="outlined"></v-text-field></v-col>
            <v-col cols="8"><v-text-field label="Achternaam" v-model="order.contact.shipping_lastname"
                variant="outlined"></v-text-field></v-col>

          </v-row>
          <v-row>
            <v-col cols="6"><v-text-field label="Straatnaam" v-model="order.contact.shipping_street_name"
                variant="outlined"></v-text-field></v-col>
            <v-col cols="2"><v-text-field label="Huisnummer" v-model="order.contact.shipping_house_number"
                variant="outlined"></v-text-field></v-col>
            <v-col><v-text-field label="Toevoeging" v-model="order.contact.shipping_house_number_extension"
                variant="outlined"></v-text-field></v-col>

          </v-row>
          <v-row>
            <v-col cols="2"><v-text-field label="Postcode" v-model="order.contact.shipping_postalcode"
                variant="outlined"></v-text-field></v-col>
            <v-col cols="4"><v-text-field label="Plaatsnaam" v-model="order.contact.shipping_city"
                variant="outlined"></v-text-field></v-col>
            <v-col cols="4"><v-select item-title="text" item-value="value" :items="countries" label="Land"
                v-model="order.contact.shipping_country" variant="outlined"></v-select></v-col>
          </v-row>
          <v-row>
            <v-col cols="6"><v-text-field label="E-mail" v-model="order.contact.email"
                variant="outlined"></v-text-field></v-col>
            <v-col cols="3"><v-text-field label="Telefoon" v-model="order.contact.phone"
                variant="outlined"></v-text-field></v-col>
            <v-col cols="3"><v-text-field label="Mobiel" v-model="order.contact.mobile"
                variant="outlined"></v-text-field></v-col>

          </v-row>
          <v-expansion-panels class="mt-6" elevation="0" style="border:1px solid #777">
            <v-expansion-panel elevation="0">
              <v-expansion-panel-title>
                Meer adresgegevens
              </v-expansion-panel-title>
              <v-expansion-panel-text>
                <v-row>
                  <v-col cols="4">
                    <v-text-field label="Regio" v-model="order.contact.shipping_region"
                      variant="outlined"></v-text-field>
                  </v-col>
                  <v-col cols="4">
                    <v-text-field label="Afdeling" v-model="order.contact.shipping_department"
                      variant="outlined"></v-text-field>
                  </v-col>
                  <v-col cols="4">
                    <v-text-field label="Verdieping" v-model="order.contact.shipping_floor"
                      variant="outlined"></v-text-field>
                  </v-col>
                </v-row>
              </v-expansion-panel-text>
            </v-expansion-panel>
          </v-expansion-panels>

          <div class="mt-10 product-container">
            <div v-for="(product, index) in order.products" :key="index" class="product-row"
              :class="{ selected: selectedProducts.includes(product.orderItemId) }"
              @click="toggleSelection(product.orderItemId)">
              <div class="product-title">{{ product.title }}</div>
              <div class="product-details">
                <span>Aantal: {{ product.quantity }}</span>
                <span>EAN: {{ product.ean }}</span>
                <span>Prijs: {{ formatPrice(product.price) }}</span>
              </div>
            </div>
          </div>

          <div class="total-price">Totaal: {{ calculateTotal() }}</div>



          <v-container class="shipping-preference-box">
            <v-row>
              <v-col>
                <div class="button-group">
                  <v-btn :class="{ active: selectedOption === 'Brievenbuspakje' }"
                    @click="selectOption('Brievenbuspakje')" variant="flat">
                    Brievenbuspakje
                  </v-btn>
                  <v-btn :class="{ active: selectedOption === 'Pakket' }" @click="selectOption('Pakket')"
                    variant="flat">
                    Pakket
                  </v-btn>
                </div>

                <v-text-field v-if="selectedOption === 'Pakket'" label="Verzekerd versturen" variant="outlined"
                  v-model="insuranceValue" prefix="€" class="mt-5" />
              </v-col>

            </v-row>
            <v-row>
              <v-col>
                <v-checkbox v-model="trackAndTrace" label="Track & Trace code toevoegen in Bol.com" />
              </v-col>
            </v-row>
            <v-divider></v-divider>
            <v-row class="actions" justify="start">
              <v-btn @click="downloadInvoice"  class="btn-primary action-btn">Factuur downloaden</v-btn>
              <v-btn @click="createShippingLabel" class="btn-primary action-btn">Verzendlabel maken</v-btn>
            </v-row>


          </v-container>

          <div>
            <DymoLabelPrinter labelXmlPath="https://portal.bntk.eu/labelTemplate.xml" />

          </div>
        </div>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script setup>

import { ref, reactive, computed, onMounted } from 'vue'
import { useRoute } from 'vue-router';
import axios from '@/services/axios'
import DymoLabelPrinter from '@/components/DymoLabelPrinter.vue';

import _countries from '@/countries.json'
const route = useRoute();
const order_id = computed(() => route.params.order_id);
const order = ref({
  contact: {
    shipping_company_name: '',
    shipping_firstname: '',
    shipping_lastname: '',
    shipping_street_name: '',
    shipping_house_number: '',
    shipping_house_number_extension: '',
    shipping_postalcode: '',
    shipping_city: '',
    shipping_country: '',
  },
  order_id: '',
  products: []

})
const trackAndTrace = ref(false);
const selectedProductsJson = computed(() => JSON.stringify(selectedProducts.value));

const selectedProducts = ref([]);

function toggleSelection(id) {
  if (selectedProducts.value.includes(id)) {
    selectedProducts.value = selectedProducts.value.filter((productId) => productId !== id);
  } else {
    selectedProducts.value.push(id);
  }
}

const formatPrice = (price) => {
  return new Intl.NumberFormat('nl-NL', { style: 'currency', currency: 'EUR' }).format(price);
};

const calculateTotal = () => {
  if (order.value.order_id) {
    const total = order.value.products.reduce((sum, product) => {
      return sum + product.price * product.quantity;
    }, 0);
    return formatPrice(total);
  }



};

const countries = ref(_countries)
const shippingPreferences = reactive({});

onMounted(() => {
  getOrder()

})

const getOrder = async () => {
  const response = await axios.get('/api/orders/' + order_id.value)
  order.value = response.data || {}
  if (order.value) {
    order.value.products.forEach((product) => {
      if (!shippingPreferences[product.ean]) {
        shippingPreferences[product.ean] = { method: '' }; // Default method or saved preference
      }
    });
  }

}


const selectedOption = ref(null);
const insuranceValue = ref(null);

function selectOption(option) {
  selectedOption.value = option;
}

const downloadInvoice = () => {
  console.log('Downloading invoice...');
};
const createShippingLabel = async () => {
  const response = await axios.post('/api/shippinglabel', { order: order.value })

  if (response.data.pdf.length > 0) {
    const pdf = response.data.pdf
    const linkSource = `data:application/pdf;base64,${pdf}`;
    const downloadLink = document.createElement("a");
    const fileName = "verzendlabel_" + order.value.contact.shipping_firstname.replace(/ /g, '_') + "_" + order.value.contact.shipping_lastname.replace(/ /g, '_') + "_" + order_id.value + ".pdf";
    downloadLink.href = linkSource;
    downloadLink.download = fileName;
    downloadLink.click();
  }
};

const setShippingPreference = (ean, method) => {
  if (shippingPreferences[ean]) {
    shippingPreferences[ean].method = method;
  }
};
</script>

<style scoped>
.product-container {
  display: flex;
  flex-direction: column;
  width: 100%;
  margin: auto;
  border: 1px solid #ccc;
  border-radius: 4px;
  padding: 10px;
}

.product-row {
  display: flex;
  flex-direction: column;
  padding: 10px;
  border-bottom: 1px solid #ddd;
  cursor: pointer;
  transition: background-color 0.3s;
}

.product-row:last-child {
  border-bottom: none;
}

.product-row.selected {
  background-color: #ffe5ab;
}

.product-title {
  font-weight: bold;
  margin-bottom: 5px;
}

.product-details {
  display: flex;
  justify-content: space-between;
  font-size: 0.9rem;
  color: #555;
}

.total-price {
  font-weight: bold;
  margin-top: 15px;
  text-align: right;
}


.button-group {
  display: flex;
  gap: 8px;
}

.v-btn.active {
  background-color: orange;
  color: white;
}

.v-btn:not(.active) {
  background-color: rgb(221, 221, 221);
  color: black;
}

.shipping-preference-box {
  background-color: #f9f9f9;
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 20px;
  margin-top: 20px;
}

.actions {
  margin-top: 16px;
}

.action-btn {
  margin-left: 10px;
  font-weight: 500;
}
</style>