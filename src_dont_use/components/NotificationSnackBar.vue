<template>
  <v-snackbar
    v-model="isVisible"
    :color="snackbarColor"
    timeout="3000"
    location="bottom"
    max-width="500"
  >
    {{ snackbarMessage }}
  </v-snackbar>
</template>

<script>
import eventBus from '@/eventBus';

export default {
  name: 'NotificationSnackBar',
  data() {
    return {
      isVisible: false,
      snackbarMessage: '',
      snackbarColor: 'primary', // Default color, change as needed
    };
  },
  mounted() {
    // Listen for snackbar events from the event bus
    eventBus.on('show-snackbar', this.showSnackbar);
  },
  beforeUnmount() {
    // Cleanup the listener when the component is destroyed
    eventBus.off('show-snackbar', this.showSnackbar);
  },
  methods: {
    showSnackbar({ message, color = 'primary' }) {
      // Set message and color, and show the snackbar
      this.snackbarMessage = message;
      this.snackbarColor = color;
      this.isVisible = true;
    },
  },
};
</script>