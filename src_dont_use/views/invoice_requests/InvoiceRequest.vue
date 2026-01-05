<template>
  <v-container fluid>
    <v-card class="card z-index-2 h-100">
      <v-card-text class="card-body p-3">
        <!--   
  {{ invoice.order_id }}
  {{ invoice.order_date }}
  {{ invoice.billing_details.firstName }}   {{ invoice.billing_details.surname }}
 -->

        <div class="order-summary">
          <div class="order-header">
            <!-- <h2>Bol.com order {{ invoice.order_id }}</h2> -->
            <p v-if="invoice.billing_details.company">{{ invoice.billing_details.company }}</p>
            <p>{{ invoice.billing_details.firstName }} {{ invoice.billing_details.surname }}</p>
            <p v-if="invoice.billing_details.kvkNumber">KvK-nummer: {{ invoice.billing_details.kvkNumber }}</p>
            <p v-if="invoice.billing_details.vatNumber">Btw-nummer: {{ invoice.billing_details.vatNumber }}</p>
            <p class="order-date">Besteldatum: {{ invoice.order_date }}</p>
            <p class="order-date">Aangevraagd op: {{ invoice.request_date }}</p>
          </div>
          <div class="order-products">
            <h3>Producten</h3>
            <div class="product-item" v-for="(product, index) in invoice.products" :key="index">
              <span class="product-name">{{ product.title }}<br><span style="font-size: 11px">EAN: {{ product.ean
                  }}</span></span>
              <span class="product-quantity">Aantal: {{ product.quantity }}</span>
              <span class="product-price">{{ currency(product.unitPrice) }}</span>
            </div>
          </div>
          <div class="mt-10">
            <v-btn class="btn-primary" @click="sendInvoice()">Factuur versturen</v-btn>
            <v-btn class="ml-5" @click="downloadPDF()">PDF downloaden</v-btn>
          </div>
        </div>



      </v-card-text>
    </v-card>
  </v-container>


</template>


<script setup>

import { ref, onMounted, computed } from 'vue'
import axios from 'axios'
import { useRoute } from 'vue-router';

onMounted(async () => {
  getInvoice()
})

const invoice = ref({
  order_id: '',
  billing_details: {
    firstName: '',
    surname: '',
    company: '',
    kvkNumber: '',
    vatNumber: '',
    order_date: '',
    request_date: ''
  }
})
const route = useRoute();
const order_id = computed(() => route.params.order_id);

const getInvoice = async () => {
  const response = await axios.get('/api/invoice_requests/' + order_id.value)
  invoice.value = response.data
}
const currency = (price) => {

  const formatter = new Intl.NumberFormat('nl-NL', {
    style: 'currency',
    currency: 'EUR',
  })
  return formatter.format(price)
}

const downloadPDF = async () => {
  const response = await axios.get('/api/invoice_requests/' + invoice.value.order_id + '/download')
  const pdf = response.data.pdf
  const linkSource = `data:application/pdf;base64,${pdf}`;
  const downloadLink = document.createElement("a");
  const fileName = "factuur_" + invoice.value.billing_details.firstName.replace(/ /g, '_') + "_" + invoice.value.billing_details.surname + "_" + invoice.value.order_id + ".pdf";
  downloadLink.href = linkSource;
  downloadLink.download = fileName;
  downloadLink.click();
}

const sendInvoice = () => {

}
</script>

<style scoped>
.order-summary {
  max-width: 800px;
  background: linear-gradient(145deg, #ffffff, #f1f1f1);
  border-radius: 12px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), inset 0 1px 1px rgba(255, 255, 255, 0.6);
  padding: 20px;
  margin: 20px auto;
  font-family: Arial, sans-serif;
  border: 1px solid #ececec;
}

.order-header {
  border-bottom: 1px solid #e0e0e0;
  padding-bottom: 15px;
  margin-bottom: 15px;
  text-align: center;
}

.order-header h2 {
  font-size: 1.5rem;
  margin: 0;
  color: #333;
}

.order-header p {
  font-size: 1rem;
  color: #555;
}

.order-date {
  color: #888;
  font-size: 0.9rem;
}

.order-products {
  font-size: 1rem;
}

.order-products h3 {
  margin-bottom: 10px;
  font-size: 1.2rem;
  color: #333;
}

.product-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 0;
  border-bottom: 1px solid #e0e0e0;
}

.product-item:last-child {
  border-bottom: none;
}

.product-name {
  flex: 2;
  font-weight: bold;
  color: #555;
}

.product-quantity {
  flex: 1;
  text-align: center;
  color: #777;
}

.product-price {
  flex: 1;
  text-align: right;
  font-weight: bold;
  color: #28a745;
}
</style>