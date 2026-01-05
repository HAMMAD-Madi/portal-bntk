<template>
  <ul class="navbar-nav">
    <li v-for="item in menuItems" :key="item.name" class="menu-item nav-item">
      <div v-if="item.children" class="menu-item-content" @click="toggle(item.name)">
        <!-- Icon or Placeholder for alignment -->
        <div class="menu-icon">
          <font-awesome-icon v-if="item.icon" :icon="item.icon" />
        </div>
        <!-- Display the name as text -->
        <span class="menu-text">{{ item.name }}</span>
        <!-- Chevron icons for toggle indication -->
        <font-awesome-icon :icon="isExpanded(item.name) ? 'chevron-up' : 'chevron-down'" />
      </div>
      <router-link v-else-if="item.url" :to="item.url" class="menu-item-content" tag="div" :class="{ active: $route.name === item.url }">
        <!-- Icon or Placeholder for alignment -->
        <div class="menu-icon">
          <font-awesome-icon v-if="item.icon" :icon="item.icon" />
        </div>
        <!-- Display the name as link -->
        <span class="menu-text">{{ item.name }}</span>
      </router-link>
      <span v-else class="menu-item-content">
        <!-- Placeholder for alignment -->
        <div class="menu-icon">
          <font-awesome-icon v-if="item.icon" :icon="item.icon" />
        </div>
        <!-- Display the name as text -->
        <span class="menu-text">{{ item.name }}</span>
      </span>
      <!-- Submenu -->
      <transition
        @before-enter="beforeEnter"
        @enter="enter"
        @leave="leave"
      >
        <ul v-if="isExpanded(item.name)" class="submenu">
          <tree-menu :menu-items="item.children" />
        </ul>
      </transition>
    </li>
  </ul>
</template>
  
  <script setup>
import { gsap } from 'gsap'
import { defineProps, ref, toRefs, onMounted} from 'vue'

const expanded = ref({})

const props = defineProps({
  menuItems: Array,
})
const { menuItems } = toRefs(props)


onMounted(() => {
  if (props.menuItems) {
      const expandedItems = props.menuItems.reduce((items, item) => {
        items[item.name] = true;
        return items;
      }, {});
      expanded.value = expandedItems;
    }

})

const toggle = (name) => {
  expanded.value[name] = !expanded.value[name]
}

const isExpanded = (name) => !!expanded.value[name]

const beforeEnter = (el) => {
  gsap.set(el, { height: 0 })
}

const enter = (el, done) => {
  gsap.to(el, { height: 'auto', duration: 0.3, onComplete: done })
}

const leave = (el, done) => {
  gsap.to(el, { height: 0, duration: 0.3, onComplete: done })
}
</script>

<style scoped>

.menu {
    padding-right: 15px
}
.menu-item {
    /* margin-left: 1em; */
    cursor: pointer;
}
.submenu {
  padding-left: 30px; /* Adjust as necessary for indenting */
  overflow: hidden;
}
.menu-item-content {
  display: flex;
  align-items: center;
  padding: 5px 10px; /* Add padding as needed for clickable area */
}

.menu-icon {
  width: 20px; /* Adjust as necessary */
  height: 20px; /* Adjust as necessary */
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 10px; /* Space between the icon and text */
}

.menu-text {
  flex-grow: 1;
}

.submenu li {
    /* margin-left: 5px; */
}
.menu-item-content:hover {
    background: rgba(255, 255, 255, 0.2);
    border-top-left-radius: 6px;
    border-bottom-left-radius: 6px;

}
li {
    list-style: none;
}

li a:link {
    text-decoration: none;
    /* color: white */
}

li a:hover {
    /* color: white */
}

li a:visited {
    text-decoration: none;
    /* color: white */
}

li a:active {
    text-decoration: none;
    /* color: white */
}
</style>