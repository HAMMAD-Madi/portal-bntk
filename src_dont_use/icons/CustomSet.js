import { h } from 'vue'
import barcodeIcon from './BarcodeIcon.vue'
import printerIcon from './PrinterIcon.vue'
import draghandleIcon from './DraghandleIcon.vue'

const CustomSet = {
    barcodeIcon,
    printerIcon,
    draghandleIcon
}


const aliases = {
    collapse: '...',
    complete: '...',
    cancel: '...',
    close: '...',
    delete: '...',
    clear: '...',
    success: '...',
    info: '...',
    warning: '...',
    error: '...',
    prev: '...',
    next: '...',
    checkboxOn: '...',
    checkboxOff: '...',
    checkboxIndeterminate: '...',
    delimiter: '...',
    sort: '...',
    expand: '...',
    menu: '...',
    subgroup: '...',
    dropdown: '...',
    radioOn: '...',
    radioOff: '...',
    edit: '...',
    ratingEmpty: '...',
    ratingFull: '...',
    ratingHalf: '...',
    loading: '...',
    first: '...',
    last: '...',
    unfold: '...',
    file: '...',
    plus: '...',
    minus: '...',
  }


  const custom = {
    component: (props) => h(CustomSet[props.icon], {color: props.color, class: 'v-icon__svg'})
  }
  export { aliases, custom}