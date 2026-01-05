<template>
  <v-container fluid>
    <v-card class="card z-index-2 h-100">
      <v-card-text class="card-body p-3">
        <form @submit="onSubmit">
          <v-row>
            <v-col cols="auto">
              <h1>Factuur bewerken</h1>



              <div class="info-flex-container">
                <div class="box">

                  <v-row align="center" class="pa-0 ma-0 mb-5">
                    <v-col cols="12" sm="auto" class="fullwidth pa-0 ma-0">
                      <v-select label="" solo item-title="full_name" item-value="id" return-object
                        @update:modelValue="changeContact" v-model="contactField" :items="formattedContactList"
                        class="select-custom-height"></v-select>
                    </v-col>
                    <v-col cols="auto" class="pa-0 ma-0">
                      <!-- <v-btn
        class="text-white button-custom-height"
        elevation="0"
        color="orange"
        :style="{ borderRadius: '0 4px 4px 0' }"
      >
        <v-icon size="x-large">fa-address-book</v-icon>
      </v-btn> -->




                      <v-menu v-model="contactmenu" location="end">
                        <template v-slot:activator="{ props }">
                          <v-btn class="button-custom-height" elevation="0" v-bind="props"
                            :style="{ borderRadius: '0 4px 4px 0', background: 'rgb(245, 245, 245)' }">
                            <v-icon size="x-large">fa-address-book</v-icon>

                          </v-btn>
                        </template>

                        <v-list :lines="false" density="compact" nav>


                          <v-dialog v-model="addContactDialog" width="800" persistent>
                            <template v-slot:activator="{ props }">

                              <v-list-item v-bind="props" value="addcontact" key="addcontact" color="primary">
                                <v-list-item-title v-text="`Nieuwe Klant`"></v-list-item-title>
                              </v-list-item>
                            </template>
                            <v-card>
                              <v-card-title>
                                <span class="text-h5">Nieuwe klant</span>
                              </v-card-title>
                              <v-card-text>
                                <form>
                                  <v-row>
                                    <v-col cols="6">
                                      <v-row>
                                        <v-col cols="12">
                                          <v-text-field :error-messages="newCompanyNameErrors" v-model="newcompany_name"
                                            label="Bedrijfsnaam"></v-text-field>
                                        </v-col>
                                      </v-row>
                                      <v-row>
                                        <v-col cols="12">
                                          <v-text-field :error-messages="newFirstNameErrors" v-model="newfirstname"
                                            label="Voornaam"></v-text-field>
                                        </v-col>
                                      </v-row>
                                      <v-row>
                                        <v-col cols="12">
                                          <v-text-field :error-messages="newAffixErrors" v-model="newaffix"
                                            label="Tussenvoegsel"></v-text-field>
                                        </v-col>
                                      </v-row>
                                      <v-row>
                                        <v-col cols="12">
                                          <v-text-field :error-messages="newLastNameErrors" v-model="newlastname"
                                            label="Achternaam"></v-text-field>
                                        </v-col>
                                      </v-row>
                                      <v-row>
                                        <v-col cols="12">
                                          <v-text-field :error-messages="newEmailErrors" v-model="newemail"
                                            label="E-mail"></v-text-field>
                                        </v-col>
                                      </v-row>
                                      <v-row>
                                        <v-col cols="12">
                                          <v-text-field :error-messages="newPhoneErrors" v-model="newphone"
                                            label="Telefoon"></v-text-field>
                                        </v-col>
                                      </v-row>

                                    </v-col>
                                    <v-col cols="6">
                                      <v-row>
                                        <v-col cols="12">
                                          <v-text-field :error-messages="newStreetNameErrors" v-model="newstreet_name"
                                            label="Straatnaam"></v-text-field>
                                        </v-col>
                                      </v-row>
                                      <v-row>
                                        <v-col cols="12">
                                          <v-row>
                                            <v-col cols="6">
                                              <v-text-field :error-messages="newHouseNumberErrors"
                                                v-model="newhouse_number" label="Huisnummer"></v-text-field>
                                            </v-col>
                                            <v-col cols="6">
                                              <v-text-field :error-messages="newHouseNumberExtensionErrors"
                                                v-model="newhouse_number_extension" label="Toevoeging"></v-text-field>

                                            </v-col>
                                          </v-row>
                                        </v-col>
                                      </v-row>
                                      <v-row>
                                        <v-col cols="12">
                                          <v-text-field :error-messages="newPostalcodeErrors" v-model="newpostalcode"
                                            label="Postcode"></v-text-field>
                                        </v-col>
                                      </v-row>
                                      <v-row>
                                        <v-col cols="12">
                                          <v-text-field :error-messages="newCityErrors" v-model="newcity"
                                            label="Plaats"></v-text-field>
                                        </v-col>
                                      </v-row>
                                      <v-row>
                                        <v-col cols="12">
                                          <v-text-field :error-messages="newKvkErrors" v-model="newkvk"
                                            label="KVK-nummer"></v-text-field>
                                        </v-col>
                                      </v-row>
                                      <v-row>
                                        <v-col cols="12">
                                          <v-text-field :error-messages="newVatErrors" v-model="newvat"
                                            label="Btw-nummer"></v-text-field>
                                        </v-col>
                                      </v-row>
                                      <v-row>
                                        <v-col cols="12">
                                          <v-select :error-messages="newCountryErrors" v-model="newcountry"
                                            return-object :items="countries" label="Land"></v-select>
                                        </v-col>
                                      </v-row>
                                    </v-col>
                                  </v-row>
                                </form>
                              </v-card-text>
                              <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="green-darken-1" variant="text"
                                  @click="createContact(); addContactDialog = false; contactmenu = false">
                                  Opslaan
                                </v-btn>
                                <v-btn color="green-darken-1" variant="text"
                                  @click="addContactDialog = false; contactmenu = false">
                                  Sluiten
                                </v-btn>
                              </v-card-actions>
                            </v-card>
                          </v-dialog>
                          <v-dialog v-model="editContactDialog" width="800" persistent>
                            <template v-slot:activator="{ props }">

                              <v-list-item v-bind="props" value="editcontact" key="editcontact" color="primary">
                                <v-list-item-title v-text="`Klant bewerken`"></v-list-item-title>
                              </v-list-item>
                            </template>
                            <v-card>
                              <v-card-title>
                                <span class="text-h5">Klant bewerken</span>
                              </v-card-title>
                              <v-card-text>
                                <form>
                                  <v-row>
                                    <v-col cols="6">
                                      <v-row>
                                        <v-col cols="12">
                                          <v-text-field :error-messages="companyNameErrors" v-model="company_name"
                                            label="Bedrijfsnaam"></v-text-field>
                                        </v-col>
                                      </v-row>
                                      <v-row>
                                        <v-col cols="12">
                                          <v-text-field :error-messages="firstNameErrors" v-model="firstname"
                                            label="Voornaam"></v-text-field>
                                        </v-col>
                                      </v-row>
                                      <v-row>
                                        <v-col cols="12">
                                          <v-text-field name="affix" :error-messages="affixErrors" v-model="affix"
                                            label="Tussenvoegsel"></v-text-field>
                                        </v-col>
                                      </v-row>
                                      <v-row>
                                        <v-col cols="12">
                                          <v-text-field :error-messages="lastNameErrors" v-model="lastname"
                                            label="Achternaam"></v-text-field>
                                        </v-col>
                                      </v-row>
                                      <v-row>
                                        <v-col cols="12">
                                          <v-text-field :error-messages="emailErrors" v-model="email"
                                            label="E-mail"></v-text-field>
                                        </v-col>
                                      </v-row>
                                      <v-row>
                                        <v-col cols="12">
                                          <v-text-field :error-messages="phoneErrors" v-model="phone"
                                            label="Telefoon"></v-text-field>
                                        </v-col>
                                      </v-row>

                                    </v-col>
                                    <v-col cols="6">
                                      <v-row>
                                        <v-col cols="12">
                                          <v-text-field :error-messages="streetNameErrors" v-model="street_name"
                                            label="Straatnaam"></v-text-field>
                                        </v-col>
                                      </v-row>
                                      <v-row>
                                        <v-col cols="12">
                                          <v-row>
                                            <v-col cols="6">
                                              <v-text-field :error-messages="houseNumberErrors" v-model="house_number"
                                                label="Huisnummer"></v-text-field>
                                            </v-col>
                                            <v-col cols="6">
                                              <v-text-field :error-messages="houseNumberExtensionErrors"
                                                v-model="house_number_extension" label="Toevoeging"></v-text-field>

                                            </v-col>
                                          </v-row>
                                        </v-col>
                                      </v-row>
                                      <v-row>
                                        <v-col cols="12">
                                          <v-text-field :error-messages="postalcodeErrors" v-model="postalcode"
                                            label="Postcode"></v-text-field>
                                        </v-col>
                                      </v-row>
                                      <v-row>
                                        <v-col cols="12">
                                          <v-text-field :error-messages="cityErrors" v-model="city"
                                            label="Plaats"></v-text-field>
                                        </v-col>
                                      </v-row>
                                      <v-row>
                                        <v-col cols="12">
                                          <v-text-field :error-messages="kvkErrors" v-model="kvk"
                                            label="KVK-nummer"></v-text-field>
                                        </v-col>
                                      </v-row>
                                      <v-row>
                                        <v-col cols="12">
                                          <v-text-field :error-messages="vatErrors" v-model="vat"
                                            label="Btw-nummer"></v-text-field>
                                        </v-col>
                                      </v-row>
                                      <v-row>
                                        <v-col cols="12">
                                          <v-select :error-messages="countryErrors" v-model="country" return-object
                                            :items="countries" label="Land"></v-select>
                                        </v-col>
                                      </v-row>
                                    </v-col>
                                  </v-row>
                                </form>
                              </v-card-text>
                              <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="green-darken-1" variant="text"
                                  @click="updateContact(); editContactDialog = false; contactmenu = false">
                                  Opslaan
                                </v-btn>
                                <v-btn color="green-darken-1" variant="text"
                                  @click="editContactDialog = false; contactmenu = false">
                                  Sluiten
                                </v-btn>
                              </v-card-actions>
                            </v-card>
                          </v-dialog>

                        </v-list>
                      </v-menu>





                    </v-col>
                  </v-row>

                  <div class="mt-2" v-if="contactField">
                    <strong>Factuuradres:</strong>
                    <p v-if="company_name">{{ company_name }}</p>
                    <p>{{ firstname }} {{ affix }} {{ lastname }}</p>
                    <p>
                      {{ street_name }} {{ house_number }} {{ house_number_extension }}</p>
                    <p> {{ postalcode }} {{ city }}</p>
                    <p>{{ email }}</p>
                    <p>{{ phone }}</p>
                    <p>{{ kvk }}</p>
                    <p>{{ vat }}</p>
                  </div>
                  <div class="mt-2" v-else>Geen klant geselecteerd

                  </div>
                  <div class="mt-4">
                    Factuurnummer: INV{{ invoiceNumber }}<br>
                    Factuurdatum: maandag 5 november 2023<br>
                    Betaaltermijn: {{ paymentTermField }} dagen<br>
                    Factuur gemaakt door: {{ auth.user.name }}<br>
                  </div>
                  <v-text-field v-model.number="paymentTermField" class="mt-5" variant="outlined"
                    label="Betaaltermijn"></v-text-field>
                  <v-text-field v-model="licenseNumberField" class="" variant="outlined"
                    label="Kenteken"></v-text-field>
                  <v-text-field v-model="carModelField" class="" variant="outlined" label="Automodel"></v-text-field>

                  <v-btn class="mt-4 text-white" color="#2196f3" @click="marginInvoice()">Marge Factuur</v-btn>
                  <v-btn class="mt-4 text-white" color="#2196f3" @click="downloadPDF()">PDF Downloaden</v-btn>
                  <v-btn class="mt-4 text-white" color="#f00" @click="deleteInvoiceWarn()">Factuur verwijderen</v-btn>
                  <v-btn class="mt-3 text-white" color="#66bb6a" type="submit">Factuur opslaan</v-btn>

                </div>

              </div>
            </v-col>
            <v-col>

              <v-sheet style="border: 1px solid #ccc" class="mt-10 invoice-table">
                <div class="flex-container header">
                  <div style="justify-content: center; flex:4">Beschrijving</div>
                  <div>Aantal</div>
                  <div>Marge (%)</div>
                  <div>BTW tarief (%)</div>
                  <div>Prijs</div>
                  <div>Subtotaal</div>
                  <div></div>

                </div>
                <div id="invoiceitems">
                  <div class="flex-container" v-for="(item, index) in fields" :key="index">
                    <!-- <textarea style="border:1px solid #ccc" placeholder="Voer beschrijving in" v-model="item.description" class="item-description"></textarea> -->
                    <div style="flex: 4;justify-content: start;">
                      <Field v-model="item.description" class="description-container"
                        :name="`items[${index}].description`" as="div" v-slot="{ field }">
                        <textarea v-bind="field" class="item-description" placeholder="Voer beschrijving in"></textarea>
                        <ErrorMessage class="description-error" :name="`items[${index}].description`"></ErrorMessage>
                      </Field>
                    </div>
                    <Field data-name="quantity" style="align-self: stretch;" v-bind="item.quantity"
                      :name="`items[${index}].quantity`" type="number" @input="recalculate" />
                    <Field data-name="margin" style="align-self: stretch;" v-bind="item.margin"
                      :name="`items[${index}].margin`" type="number" step="any" @input="recalculate" />
                    <Field data-name="taxRate" style="align-self: stretch;" v-bind="item.taxRate"
                      :name="`items[${index}].taxRate`" type="number" @input="recalculate" />
                    <Field data-name="price" style="align-self: stretch;" v-bind="item.price"
                      :name="`items[${index}].price`" type="number" step="any" @input="recalculate" />

                    <div class="item-total">{{ calculateTotal(item) }}</div>
                    <v-col cols="auto">
                      <!-- <v-btn icon="fa-trash-can" size="small" class="text-white" color="red" @click="removeItem(index)"></v-btn> -->


                      <v-menu location="start">
                        <template v-slot:activator="{ props }">
                          <v-btn dark v-bind="props">
                            Menu
                          </v-btn>
                        </template>

                        <v-list :lines="false" density="compact" nav>

                          <v-dialog v-model="dialog" width="800">
                            <template v-slot:activator="{ props }">

                              <v-list-item v-bind="props" value="load" key="load" color="primary">
                                <v-list-item-title v-text="`Product laden`"></v-list-item-title>
                              </v-list-item>
                            </template>
                            <v-card>
                              <v-card-title>
                                <span class="text-h5">Product laden</span>
                              </v-card-title>
                              <v-card-text>
                                <v-autocomplete label="Product zoeken" :items="products" variant="solo-filled"
                                  v-model="product" @update:modelValue="updateProduct()"></v-autocomplete>
                              </v-card-text>
                              <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="green-darken-1" variant="text" @click="dialog = false">
                                  Opslaan
                                </v-btn>
                                <v-btn color="green-darken-1" variant="text" @click="dialog = false">
                                  Sluiten
                                </v-btn>
                              </v-card-actions>
                            </v-card>
                          </v-dialog>

                          <v-list-item @click="remove(index)" value="delete" key="delete" color="primary">
                            <v-list-item-title v-text="`Verwijderen`"></v-list-item-title>
                          </v-list-item>
                        </v-list>
                      </v-menu>

                    </v-col>
                    <v-icon style="cursor: pointer; width: 25px" class="handle">custom:draghandleIcon</v-icon>

                  </div>
                </div>
                <v-btn class="ml-2 my-5 text-white" color="#2196f3" @click="addItem()">Nieuwe regel</v-btn>
                <div class="flex-container footer">
                  <div v-if="!isMargin" style="font-weight: bold">Subtotaal: {{ formatCurrency(subtotal) }}</div>
                  <div v-if="!isMargin" style="font-weight: bold">BTW: {{ formatCurrency(tax) }}</div>
                  <div style="font-weight: bold">Totaal: {{ formatCurrency(total) }}</div>
                </div>
              </v-sheet>
            </v-col>
          </v-row>
        </form>



        <v-dialog v-model="deleteInvoiceWarning" width="auto">
          <v-card>
            <v-card-text>
              Weet je zeker dat je deze factuur wilt verwijderen?
            </v-card-text>
            <v-card-actions>
              <v-btn color="red-darken-1" variant="text"
                @click="deleteInvoiceWarning = false; deleteInvoice()">Bevestigen</v-btn>
              <v-btn color="green-darken-1" variant="text" @click="deleteInvoiceWarning = false;">Sluiten</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>



      </v-card-text>
    </v-card>
  </v-container>


</template>

<script setup>
import { ref, computed, onMounted, nextTick, watch, toRef } from 'vue'
import axios from '@/services/axios'
import { configure, Form as ValidationForm, ErrorMessage, Field, useForm, useField, useFieldArray } from 'vee-validate';
import * as yup from 'yup';
import '@/languages/yup-nl_NL.js'
import { setLocale } from 'yup';
import { useRoute, useRouter } from 'vue-router'
import PCMTextField from '@/components/PCMTextField.vue'
import draggable from "vuedraggable";
import { useSortable, moveArrayElement } from '@vueuse/integrations/useSortable'
import { toValue } from '@vueuse/core'
import { useAuthStore } from '@/stores/auth'

//const list = ref([{ id: 1, name: 'a' }, { id: 2, name: 'b' }, { id: 3, name: 'c' }])

let itemsOrder = []
const test = () => {
  alert('123')
}

const route = useRoute()
const router = useRouter()
const invoiceNumber = ref()
const contactmenu = ref(false)
invoiceNumber.value = route.params.number
const inputValue = ref('')
const countries = ref([])
const priceWithMargin = ref()
const isMargin = ref(false)
const deleteInvoiceWarning = ref(false)

const invoiceId = ref(null)

const emailSchema = yup.object({
  email: yup.string().required().email(),
});

const message = [
  "vue.draggable",
  "draggable",
  "component",
  "for",
  "vue.js 2.0",
  "based",
  "on",
  "Sortablejs"
];

function addItem() {
  const item = { description: '', quantity: 0, discount: 0, taxRate: 21, price: 0, order: 1 }
  push(item)
  itemsOrder.push(item)
}

const drag = ref(false)

const auth = useAuthStore()


const marginInvoice = () => {
  isMargin.value = !isMargin.value
  console.log(isMargin.value)
}

const createContact = async () => {


  let fullname = newfirstname.value || '' + ' ' + newaffix.value || '' + ' ' + newlastname.value || ''

  const contactObject = {

    firstname: newfirstname.value,
    affix: newaffix.value,
    lastname: newlastname.value,
    company_name: newcompany_name.value,
    street_name: newstreet_name.value,
    house_number: newhouse_number.value,
    house_number_extension: newhouse_number_extension.value,
    postalcode: newpostalcode.value,
    city: newcity.value,
    country: newcountry.value,
    phone: newphone.value,
    mobile: newmobile.value,
    email: newemail.value,
    kvk: newkvk.value,
    vat: newvat.value,
    full_name: fullname
  }
  const response = await axios.post('/api/contacts', { contact: contactObject })
  contactObject.id = response.data.id

  contactList.value.push(contactObject)
  fullname = { full_name: newfirstname.value || '' + ' ' + newaffix.value || '' + ' ' + newlastname.value || '', value: response.data.id }

  setContactField(fullname)

  setFirstname(contactObject.firstname)
  setLastname(contactObject.lastname)
  setAffix(contactObject.affix)
  setCompanyName(contactObject.company_name)
  setStreetname(contactObject.street_name)
  setHouseNumber(contactObject.house_number)
  setPostalcode(contactObject.postalcode)
  setCity(contactObject.city)
  setCountry(contactObject.country)
  setPhone(contactObject.phone)
  setMobile(contactObject.mobile)
  setEmail(contactObject.email)
  setKvk(contactObject.kvk)
  setVat(contactObject.vat)
}

const updateContact = async () => {



  const contactObject = {

    id: contactField.value.value,
    firstname: firstname.value,
    affix: affix.value,
    lastname: lastname.value,
    company_name: company_name.value,
    street_name: street_name.value,
    house_number: house_number.value,
    house_number_extension: house_number_extension.value,
    postalcode: postalcode.value,
    city: city.value,
    country: country.value,
    phone: phone.value,
    mobile: mobile.value,
    email: email.value,
    kvk: kvk.value,
    vat: vat.value
  }
  const response = await axios.put('/api/contacts', { contact: contactObject })
  const fullname = { full_name: (response.data.firstname ? response.data.firstname + ' ' : '') + (response.data.affix ? response.data.affix + ' ' : '') + response.data.lastname ?? '', value: response.data.id }

  setContactField(fullname)
}


const dragOptions = computed(() => {
  return {
    animation: 200,
    group: "description",
    disabled: false,
    ghostClass: "ghost",
    handle: '.handle',
    forceFallback: true
  }
})




const addContactDialog = ref(false)
const editContactDialog = ref(false)

const schema = yup.object().shape({
  //contactSelectedField: yup.object().required().label('Klant'),
  items: yup
    .array()
    .of(
      yup.object().shape({
        description: yup.string().required().label('Beschrijving'),
      })
    )
    .strict(),
});


const deleteInvoice = async () => {
  const response = await axios.delete('/api/invoices/' + invoiceId.value)

  if (response.data.status == 'deleted') {
    router.push('/facturen')

  } else {
    alert('Factuur verwijderen is mislukt')
  }

}

const deleteInvoiceWarn = () => {
  deleteInvoiceWarning.value = true
  return
}

// configure({
//   generateMessage: localize('nl', Dutch), // Dutch messages for Vee-Validate
//   // other configurations...
// });


const changeContact = (event) => {
  console.log('contact select changed')
  //setFirstname(event.firstname)

  //console.log(event.value.value)
  const fullname = { full_name: event.firstname || '' + ' ' + event.affix || '' + ' ' + event.lastname, value: event.id }
  setContactField(fullname)  // firstname.value = contact.firstname
  setFirstname(event.firstname)
  setLastname(event.lastname)
  setAffix(event.affix)
  setCompanyName(event.company_name)
  setStreetname(event.street_name)
  setHouseNumber(event.house_number)
  setPostalcode(event.postalcode)
  setCity(event.city)
  setCountry(event.country)

}

const { handleSubmit, handleReset, errors } = useForm({
  validationSchema: schema
})


const onSubmit = handleSubmit(async (values) => {

  const items = document.querySelectorAll('#invoiceitems > div')
  const items_v = []
  for (const item of items) {
    const inputs = item.querySelectorAll(':scope > input')
    const textarea = item.querySelector(':scope textarea')
    const item_v = {}
    for (const input of inputs) {
      item_v[input.dataset.name] = input.value
    }
    item_v['description'] = textarea.value
    items_v.push(item_v)
    //console.log(item)
  }
  console.log(items_v)
  //console.log(values)

  values.items = items_v
  values.ismargin = isMargin.value
  await axios.put('/api/invoices/' + invoiceNumber.value, values)
  //console.log('Submitted with', values);
});

// const these = computed(() => {
//     return JSON.stringify(errors.value)
// })




const newContact = ref({
  firstname: null,
  affix: null,
  lastname: null,
  company_name: null,
  street_name: null,
  house_number: null,
  house_number_extension: null,
  postalcode: null,
  city: null,
  country: null,
  phone: null,
  mobile: null,
  email: null,
  kvk: null,
  vat: null,
  title: ''
})
//const contactSelectedField = useField('contactSelectedField', contactSelected )
const { value: firstname, setValue: setFirstname, errors: firstNameErrors } = useField('firstname', 'required|min:8')
const { value: affix, setValue: setAffix, errors: affixErrors } = useField('affix')
const { value: lastname, setValue: setLastname, errors: lastNameErrors } = useField('lastname')
const { value: company_name, setValue: setCompanyName, errors: companyNameErrors } = useField('company_name')
const { value: street_name, setValue: setStreetname, errors: streetNameErrors } = useField('street_name')
const { value: house_number, setValue: setHouseNumber, errors: houseNumberErrors } = useField('house_number')
const { value: house_number_extension, setValue: setHouseNumberExtension, errors: houseNumberExtensionErrors } = useField('house_number_extension')
const { value: postalcode, setValue: setPostalcode, errors: postalCodeErrors } = useField('postalcode')
const { value: city, setValue: setCity, errors: cityErrors } = useField('city')
const { value: country, setValue: setCountry, errors: countryErrors } = useField('country')
const { value: phone, setValue: setPhone, errors: phoneErrors } = useField('phone')
const { value: mobile, setValue: setMobile, errors: mobileErrors } = useField('mobile')
const { value: email, setValue: setEmail, errors: emailErrors } = useField('email')
const { value: kvk, setValue: setKvk, errors: kvkErrors } = useField('kvk')
const { value: vat, setValue: setVat, errors: vatErrors } = useField('vat')

const { value: newfirstname, setValue: setNewFirstname, errors: newFirstNameErrors } = useField('new_firstname', 'required|min:8')
const { value: newaffix, setValue: setNewAffix, errors: newAffixErrors } = useField('new_affix')
const { value: newlastname, setValue: setNewLastname, errors: newlastNameErrors } = useField('new_lastname')
const { value: newcompany_name, setValue: setNewCompanyName, errors: newCompanyNameErrors } = useField('new_company_name')
const { value: newstreet_name, setValue: setNewStreetname, errors: newStreetNameErrors } = useField('new_street_name')
const { value: newhouse_number, setValue: setNewHouseNumber, errors: newHouseNumberErrors } = useField('new_house_number')
const { value: newhouse_number_extension, setValue: setNewHouseNumberExtension, errors: newHouseNumberExtensionErrors } = useField('new_house_number_extension')
const { value: newpostalcode, setValue: setNewPostalcode, errors: newPostalCodeErrors } = useField('new_postalcode')
const { value: newcity, setValue: setNewCity, errors: newCityErrors } = useField('new_city')
const { value: newcountry, setValue: setNewCountry, errors: newCountryErrors } = useField('new_country')
const { value: newphone, setValue: setNewPhone, errors: newPhoneErrors } = useField('new_phone')
const { value: newmobile, setValue: setNewMobile, errors: newMobileErrors } = useField('new_mobile')
const { value: newemail, setValue: setNewEmail, errors: newEmailErrors } = useField('new_email')
const { value: newkvk, setValue: setNewKvk, errors: newKvkErrors } = useField('new_kvk')
const { value: newvat, setValue: setNewVat, errors: newVatErrors } = useField('new_vat')

const products = ref(['foo', 'bar', 'baz'])
const dialog = ref(false)
const formattedContactList = computed(() => {
  return contactList.value.map(contact => ({
    ...contact,
    title: contact.lastname
      ? `${contact.firstname} ${contact.affix} ${contact.lastname}`.trim()
      : contact.company_name,
  }));
});


const downloadPDF = async () => {
  const response = await axios.get('/api/downloadinvoice/' + invoiceNumber.value)

  if (response.data.error !== undefined) {
    console.log(response.data.error)
    this.errorDialog = true
    this.errorMessage = response.data.error
    return
  }
  const pdf = response.data.pdf
  const linkSource = `data:application/pdf;base64,${pdf}`;
  const downloadLink = document.createElement("a");
  console.log('contact selected field: ', contactField.value)
  const fileName = "factuur_" + invoiceNumber.value + "_" + slugify(contactField.value.full_name) + ".pdf";
  downloadLink.href = linkSource;
  downloadLink.download = fileName;
  downloadLink.click();

}

const contactList = ref([])


const { move, replace, remove, push, fields, update, insert } = useFieldArray('items')

const slugify = (str) => {
  return str.toLowerCase()
    .replace(/ /g, "-")
    .replace(/[^\w-]+/g, "");
}

const sortableList = ref(null);

const orderedFieldIds = computed(() => fields.value.map(f => f.key));
watch(fields, (newFields) => {
  orderedFieldIds.value = newFields.map(f => f.key);
}, { immediate: true });
const findFieldIndex = (fieldId) => {
  return fields.value.findIndex(f => f.key === fieldId);
};


const sortOrder = [];

useSortable('#invoiceitems', sortableList, {
  handle: '.handle',
  onUpdate: (e) => {
    console.log(itemsOrder)
    //const movedItemId = orderedFieldIds.value[e.oldIndex];
    // const element = document.querySelector(e.originalEvent.srcElement)
    // element.find
    //orderedFieldIds.value.splice(e.oldIndex, 1);
    //orderedFieldIds.value.splice(e.newIndex, 0, movedItemId);


  }
})

const saveInvoice = async () => {


  await axios.post('/api/invoices', {
    contactSelected: contactSelected.value,
    items: items.value

  })
}

const updateProduct = () => {
  alert('updated')
}

const debug = (val) => {
  //move(0, 3)
  console.log(contactSelectedField.errorMessage)
  //console.log(val)
}

const onEnd = (e) => {
  // move(1, 7)
  // let updatedFields = [...fields.value];

  // console.log(updatedFields)
  // Temporary variable for the order of the moved item
  //let updatedFields = [...fields.value];
  // const objectToMove = updatedFields.splice(e.oldIndex, 1);
  // console.log(e.oldIndex)
  // //console.log(e.newIndex)
  // // Insert the object at the new position
  // updatedFields.splice(e.newIndex, 0, objectToMove);
  // // Update order properties
  // for (let i = 0; i < updatedFields.length; i++) {
  //   updatedFields[i].value.order = i;
  // }
  // console.log(updatedFields)

  // Set the order of the moved item
  //fields.value = updatedFields
};

const contactSelected = ref({ full_name: '', value: null })
const { value: contactField, setValue: setContactField } = useField('contactSelectedField', contactSelected)

const { value: paymentTermField, setValue: setPaymentTerm } = useField('paymentTermField')

const { value: licenseNumberField, setValue: setLicenseNumber } = useField('licenseNumberField')

const { value: carModelField, setValue: setCarModel } = useField('carModelField')



onMounted(async () => {

  const responseContacts = await getContacts()
  contactList.value = responseContacts.data

  const response = await axios.get('/api/countries')
  countries.value = response.data
  const contact = await getInvoice()
  //console.log(contact)
  const fullname = { full_name: (contact.firstname ? contact.firstname + ' ' : '') + (contact.affix ? contact.affix + ' ' : '') + (contact.lastname ?? ''), value: contact.id }
  setContactField(fullname)  // firstname.value = contact.firstname
  setFirstname(contact.firstname)
  setLastname(contact.lastname)
  setAffix(contact.affix)
  setCompanyName(contact.company_name)
  setStreetname(contact.street_name)
  setHouseNumber(contact.house_number)
  setPostalcode(contact.postalcode)
  setCity(contact.city)
  setCountry(contact.country)

  //console.log( countries.value)
})

const getInvoice = async () => {
  return new Promise(async (resolve, reject) => {
    const response = await axios.get('/api/invoices/' + invoiceNumber.value)

    invoiceId.value = response.data.id
    itemsOrder = []
    setPaymentTerm(response.data.payment_term)
    isMargin.value = response.data.ismargin
    setLicenseNumber(response.data.license_number)
    setCarModel(response.data.car_model)

    //console.log(contactSelectedField.value)
    replace(response.data.items)

    itemsOrder = response.data.items

    resolve(response.data.contact)
  })

}

const getContacts = async () => {
  return axios.get('/api/contacts')
}

// const addItem = () => {
//   items.value.push({ description: '', quantity: 0, discount: 0, taxRate: 21, price: 0 });
// };

// const removeItem = (index) => {
//   items.value.splice(index, 1);
// };

const recalculate = () => {
  // This function is used to trigger Vue's reactivity system
};

const calculateTotal = (item) => {
  //const priceAfterDiscount = item.value.price - (item.value.price * (item.value.discount / 100));
  const priceWithMargin = item.value.price * (1 + ((item.value.margin == undefined ? 0 : item.value.margin) / 100));
  const total = item.value.quantity * priceWithMargin;
  return formatCurrency(total);
};

const subtotal = computed(() => {
  return fields.value.reduce((sum, item) => {
    //const priceAfterDiscount = item.value.price - (item.value.price * (item.value.discount / 100));
    const priceWithMargin = item.value.price * (1 + ((item.value.margin == undefined ? 0 : item.value.margin) / 100));
    return sum + priceWithMargin * item.value.quantity;
  }, 0);
});

const tax = computed(() => {
  if (isMargin.value == false) {
    return fields.value.reduce((sum, item) => {
      //const priceAfterDiscount = item.value.price - (item.value.price * (item.value.discount / 100));
      const priceWithMargin = item.value.price * (1 + ((item.value.margin == undefined ? 0 : item.value.margin) / 100));
      return sum + (priceWithMargin * item.value.quantity * (item.value.taxRate / 100));
    }, 0);
  } else {
    return 0
  }

});

const total = computed(() => {
  return subtotal.value + tax.value;
});
const formatCurrency = (value) => {
  let Euro = new Intl.NumberFormat('nl-NL', {
    style: 'currency',
    currency: 'EUR',
  })

  return Euro.format(value)
}

</script>

<style scoped>
.flex-container {
  display: flex;
  align-items: center;
  /* Center items vertically */
  padding: 10px;
  border-bottom: 1px solid #ccc;
}

.header>div,
.flex-container>input,
.flex-container>button {
  flex: 1;
  /* Assign equal width to all children */
  padding: 5px;
  text-align: center;
  /* Align the text to the right by default */
}


.header-description,
.flex-container>textarea {
  text-align: left;
  /* Align the description to the left */
  flex: 4;
  /* Make the description field wider */
}


.flex-container>div,
.flex-container>input,
.flex-container>textarea,
.flex-container>button {
  /* Adjust the padding and flex basis as needed */
  padding: 5px;
  margin: 0 5px;
  /* Space between fields */
}



.flex-container.header,
.flex-container.footer {
  background-color: #f8f8f8;
  border: none;
}

.flex-container.footer {
  flex-flow: column;
}

.flex-container.footer div {
  align-self: end
}

.flex-container>div,
.flex-container>input,
.flex-container {
  flex: 1;
  padding: 5px;
  display: flex;
  align-items: center;
  /* Align items vertically in the center */
  justify-content: center;
}

input[type="number"] {
  flex: 1;
  /* Ensures other inputs take up equal space */
  text-align: right;
  width: 50px;
}

.item-total {
  flex: 1;
  text-align: right;
  padding: 5px;
  /* ... other styles ... */
}

button {
  margin-left: 0px;
  /* Space before the delete button */
}


/* Add some padding and margins to space out elements */
.header>div,
.footer>div {
  text-align: center;
  margin-right: 5px;
  /* Space between header/footer items */
}

/* Increase the specificity for the first child to override margins */
.flex-container>div:first-child,
.flex-container>input:first-child {
  margin-right: 0;
  text-align: left;
  /* Align the description text to the left */
}

/* Style for the Delete button to make it visually distinct */
/* .flex-container button {
background-color: #ff6666;
color: white;
border: none;
padding: 5px 10px;
cursor: pointer;
} */

/* Hover effect for the button */
/* button:hover {
background-color: #ff4d4d;
} */

/* Styling for Add Row button to make it stand out as an action button */

.add-row-button:hover {
  background-color: #45a049;
}





/* Container styling */
.info-flex-container {
  display: flex;
  flex-wrap: wrap;
  gap: 15px;
  /* Space between the boxes */
  align-items: flex-start;
}

/* Box styling */
.box {
  border: 1px solid #ccc;
  padding: 10px;
  min-width: 250px;
  margin: 0;
  /* No margin to interfere with flexbox gap */
  background-color: #fff;
  /* Light grey background */
  display: flex;
  flex-direction: column;
  /* Stack children vertically */
}

/* Title styling */
.title {
  font-size: 16px;
  font-weight: bold;
  margin-bottom: 10px;
  /* Space between the title and the rest of the box content */
}



:deep(.v-field) {
  border-radius: 4px 0px 0px 4px
}


.select-custom-height .v-select__selections {
  height: 100%;
  /* This ensures the content of the select fills the height */
}

.select-custom-height .v-input__control {
  min-height: var(--v-select-height, 57px);
  /* This sets a minimum height; adjust as needed */
}

.fullwidth {
  flex: 1 1 auto !important;
}



.button-custom-height {
  position: relative;
  top: -11px;
  height: var(--v-select-height, 56px);
  /* Adjust the height to match the select */
  padding-top: 0;
  /* Remove padding if necessary */
  padding-bottom: 0;
  /* Remove padding if necessary */
  border-bottom: 1px solid #a7a7a7
}

/* Ensure the inner content of the button is centered */
.button-custom-height .v-btn__content {
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}


.description-container {
  width: 100%;
  display: inline !important;
}


.description-error {
  display: inline;
  font-size: 12px;
  position: relative;
  top: -11px;
  color: red;
}

.item-description {
  display: inline;
  padding: 5px;
  margin-right: 5px;
  /* Ensure there is space between the textarea and the next input */
  height: auto;
  /* Adjust height as needed, or set to a specific value */
  resize: vertical;
  /* Allows the user to resize the textarea vertically */
  border: 1px solid #ccc;
  width: 100%
}



/* draggable */


.flip-list-move {
  transition: transform 0.5s;
}

.no-move {
  transition: transform 0s;
}

.ghost {
  opacity: 0.5;
  background: #c8ebfb;
}

.list-group {
  min-height: 20px;
}

#invoiceitems input {
  border: 1px solid #aaa
}

/* .list-group-item {
  cursor: move;
} */

/* end draggable */
</style>