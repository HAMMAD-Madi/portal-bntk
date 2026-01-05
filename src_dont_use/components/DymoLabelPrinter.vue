<template>
    <div>
      <button @click="renderPreview" :disabled="!labelXml || !dymoAvailable">Render Label Preview</button>
      <div v-if="labelPreview" class="label-preview">
        <img :src="labelPreview" alt="Label Preview" />
      </div>
      <button @click="printLabel" :disabled="!labelPreview || !dymoAvailable">Print Label</button>
      <p v-if="!dymoAvailable" class="error">DYMO SDK is not available. Please check your connection and try again.</p>
    </div>
  </template>
  
  <script setup>
  import { ref, watch, onMounted } from 'vue';
  
  const props = defineProps({
    labelXmlPath: {
      type: String,
      required: true,
    },
  });
  
  const labelXml = ref(null);
  const labelPreview = ref(null);
  const dymoAvailable = ref(false);
  const printerName = "DYMO LabelWriter 4XL"; // Set to your connected printer's name
  
  // Check if the DYMO SDK is loaded
  function checkDymoSdk() {
    dymoAvailable.value = !!window.dymo && !!window.dymo.label && !!window.dymo.label.framework;
  }
  
  // Load the label XML from the specified path
  async function loadLabelXml() {
    try {
      const response = await fetch(props.labelXmlPath);
      if (!response.ok) throw new Error("Failed to load label XML");
      labelXml.value = await response.text();
    } catch (error) {
      console.error("Error loading label XML:", error);
    }
  }
  
  // Render the label preview image
  function renderPreview() {
    if (!dymoAvailable.value || !labelXml.value) return;
  
    try {
      const label = dymo.label.framework.openLabelXml(labelXml.value);
  
      if (!label.isValidLabel()) {
        console.error("Invalid label format");
        return;
      }
  
      // Set rendering parameters for the label
      const renderParamsXml = `<LabelRenderParams>
                                 <LabelType>1744907</LabelType>
                               </LabelRenderParams>`;
  
      // Render the label preview and display it
      labelPreview.value = label.render(renderParamsXml, printerName);
    } catch (error) {
      console.error("Error rendering label preview:", error);
    }
  }
  
  // Print the label
  function printLabel() {
    if (!dymoAvailable.value || !labelPreview.value) return;
  
    try {
      const label = dymo.label.framework.openLabelXml(labelXml.value);
      label.print(printerName);
    } catch (error) {
      console.error("Error printing label:", error);
    }
  }
  
  // Load label XML and check DYMO SDK when the component is mounted
  onMounted(() => {
    checkDymoSdk();
    loadLabelXml();
  });
  watch(() => props.labelXmlPath, loadLabelXml);
  </script>
  
  <style>
  .label-preview img {
    max-width: 100%;
    height: auto;
  }
  .error {
    color: red;
    font-size: 0.9em;
  }
  </style>