import './bootstrap';

import { createApp } from 'vue'
// import PostIndex from './components/Posts/Index'
import PostIndex from './components/Tree'

const app = createApp({})
app.component('posts-index', PostIndex)
app.mount('#app_example')
