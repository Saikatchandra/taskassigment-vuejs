<template>
  <div>
        <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Task add</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Task add</li>
              </ol>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->

      <section class="content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Add new Task</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form  @submit.prevent="saveTask" @keydown="form.onKeydown($event)">
                  <div class="card-body">
                    <div class="form-group">
                      <div>
                        <label for="exampleInputEmail1">Title</label>
                      <input
                        type="text"
                        class="form-control"
                        name="title"
                        v-model="form.title"
                        id="exampleInputEmail1"
                        placeholder="Enter title"
                      />
                      <div
                        v-if="form.errors.has('title')"
                        v-html="form.errors.get('title')"
                      />
                      </div>
                      <div>
                        <label for="exampleInputEmail1">Description</label>
                      <textarea name="description" id="" cols="30" rows="10" v-model="form.description" class="form-control" placeholder="Enter Description of task"></textarea>
                      <div
                        v-if="form.errors.has('description')"
                        v-html="form.errors.get('description')"
                      />
                      </div>
                      <div>
                        <label for="exampleInputEmail1">Deadline</label>
                        <input type="date" name="deadline" class="form-control" v-model="form.deadline" />
                      <div
                        v-if="form.errors.has('deadline')"
                        v-html="form.errors.get('deadline')"
                      />
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-3">
                      Submit
                    </button>
                    <router-link to="/" class="btn btn-warning">
                      Back</router-link
                    >
                    <!-- <button type="submit" @click="goBack" class="btn btn-warning">Back</button> -->
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>

      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  </div>
</template>

<script>
import Form from "vform";
export default {
  name: "add",

   data: () => ({
    form: new Form({
      title: "",
      description: "",
      deadline: "",
    }),
  }),
  
  methods:{
    saveTask(){
      this.form.post('/saveTask')
      .then((res) => {
        console.log(res);
        this.$router.push('/');
        Toast.fire({
            icon: "success",
            title: "Task Added successfully",
          });
      }).catch((e) => {
        console.log(e);
      })
    }
  }


};
</script>

<style lang="scss" scoped>
</style>