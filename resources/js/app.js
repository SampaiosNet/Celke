import './bootstrap';

window.confimDelete = function(id) 
{
   Swal.fire({
      title: "Tem certeza?",
      text: "Esta ação não poderá ser desfeita!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sim, excluir!"
   }).then((result) => {
      if (result.isConfirmed) 
      {
         document.getElementById('delete-form-' + id).submit();
      }
   });
};