import './bootstrap';

import { createApp } from 'vue'
import PostIndex from './components/Posts/Index'

const app = createApp({})
app.component('posts-index', PostIndex)
app.mount('#app_example')
