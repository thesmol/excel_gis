<script>
export default {
  name: 'TreeItem', // necessary for self-reference
  props: {
    model: Object
  },
  data() {
    return {
      showChildren: false,
      isOpen: false,
      tree: {
        name: "Недропользователи",
        amount: "-",
        nodes: [ ],
        message: "root",
        id: 0,
      },
    }
  },
  computed: {
        indent() {
      return { transform: `translate(${this.depth * 15}px)` }
    },
    isFolder() {
      return this.model.children && this.model.children.length
    }
  },

  methods: {

    GetCompanies(){
        if (this.isFolder) {
        this.isOpen = !this.isOpen
      }
      axios.get('/api/rootCompany')
        .then(
            res => {
          let companies = res.data.data
          for(let i = 0; i < companies.length; i++){
            let Currentname = {
              name: companies[i].name,
              amount: companies[i].amount,
              nodes: [],
              message: res.data.message,
              id: companies[i].id,
            }
            this.tree.nodes.push(Currentname)
          }
        }
        )
    },

    toggle() {
      if (this.isFolder) {
        this.isOpen = !this.isOpen
      }
    },
    changeType() {
      if (!this.isFolder) {
        this.model.children = []
        this.addChild()
        this.isOpen = true
      }
    },
    addChild() {
      this.model.children.push({
        name: 'new stuff'
      })
    }
  }
}
</script>

<template>
  <li>
    <div
      :class="{ bold: isFolder }"
      @click="toggle"
      @dblclick="changeType">
      {{ model.name }}
      <span v-if="isFolder">[{{ isOpen ? '-' : '+' }}]</span>
    </div>
    <ul v-show="isOpen" v-if="isFolder">
      <TreeItem
        class="item"
        v-for="model in model.children"
        :model="model">
      </TreeItem>
      <tree-menu v-if="showChildren" v-for="node in nodes"
        :nodes="node.nodes" :name="node.name"
        :amount="node.amount" :message="node.message"
        :id ="node.id" :depth="depth + 1">
        </tree-menu>
      <li class="add" @click="addChild">+</li>
    </ul>
  </li>
</template>
