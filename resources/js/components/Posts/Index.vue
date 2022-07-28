<script>
import TreeItem from './TreeItem.vue'

const treeData = {
  name: 'Недропользователи',
  children: [

  ]
}


export default {
  components: {
    TreeItem
  },
  data() {
    return {
      treeData
    }
  }
}
</script>

<template>
  <ul>
    <TreeItem class="item" :model="treeData"></TreeItem>
  </ul>
</template>

<style>
.item{
  cursor: pointer;
  line-height: 1.5;
  list-style-type: square;
}
.bold {
  font-weight: bold;
  }

</style>


