function modalAddItem(t){const e=$("#genericModal");$.get("/cliente/catalogo/"+t+"/adicionar-item").done(function(t){$("#genericModal .modal-body").html(t),e.modal("show")}).fail(function(t){console.log(t),alert("deu tiuti")})}function addItemToShoppingCart(t,e,o,i,s,a){item=[t,e,o,i,s,a],window.sessionStorage.getItem("items")?(items=window.sessionStorage.getItem("items"),items=JSON.parse(items),items.push(item),$("#spccounter").html(items.length),window.sessionStorage.setItem("items",JSON.stringify(items)),console.log(items)):window.sessionStorage.setItem("items",JSON.stringify([item])),$("#genericModal").modal("hide"),alert(e+" adicionado ao carrinho")}function updateTable(){if(window.sessionStorage.getItem("items"))for(items=window.sessionStorage.getItem("items"),items=JSON.parse(items),items.length>0?($("#process-order-button").removeClass("disabled"),$("#process-order-button").attr("disabled",!1)):($("#process-order-button").addClass("disabled"),$("#process-order-button").attr("disabled",!0)),total=0,html="",cont=0;cont<items.length;cont++)id=items[cont][0],name=items[cont][1],description=items[cont][2],quantity=items[cont][3],price=items[cont][4],image=items[cont][5],body='<tr id="row-'+id+'">',body+='<td data-th="Produtos">',body+='<div class="row">',body+='<div class="col-sm-2 hidden-xs">',body+='<img src="'+image+'" alt="..." class="img-responsive"/>',body+="</div>",body+='<div class="col-sm-10">',body+='<h4 class="nomargin">'+name+"</h4>",body+="<p>"+description+"</p>",body+="</div>",body+="</div>",body+="</td>",body+='<td data-th="Preço">R$ '+price+"</td>",body+='<td data-th="Quantidade">',body+='<input type="hidden" name="items[]" value="'+id+'">',body+='<input type="number" class="form-control text-center quantity" name="quantity[]" onChange="updateItemTable('+cont+', this)" value="'+quantity+'">',body+="</td>",body+='<td data-th="Subtotal" class="text-center">'+parseFloat((quantity*price).toFixed(2))+"</td>",body+='<td class="actions" data-th="">',body+='<button type="button" class="btn btn-danger btn-sm" onclick="deleteItem('+id+","+cont+',this)"><i class="fa fa-fw fa-trash-alt"></i></button>',body+="</td>",body+="</tr>",html+=body,total+=parseFloat((quantity*price).toFixed(2)),$(".total-price").html("Total R$ "+total.toFixed(2));else console.log("num tem nada"),html="",body='<tr><td class="text-center" colspan="5">Sem produtos adicionados ao carrinho...</td></tr>',html+=body,$(".total-price").length&&".total-price".html("Total R$ 0,00");$("#cart tbody").html(html)}function updateItemTable(t,e){items=window.sessionStorage.getItem("items"),items=JSON.parse(items),items[t][3]=$(e).val(),window.sessionStorage.setItem("items",JSON.stringify(items)),updateTable()}function deleteItem(t,e,o){items=window.sessionStorage.getItem("items"),items=JSON.parse(items),items.splice(e,1),window.sessionStorage.setItem("items",JSON.stringify(items)),$("#row-"+t).remove(),updateTable()}function processOrder(){window.sessionStorage.removeItem("items"),$("#checkout-table #checkout-form").submit()}function editCategory(t,e){const o=$("#genericModal");e=$(e),$.get("/admin/categorias/"+t).done(function(t){$("#genericModal .modal-title").html("Edição de Categoria"),$("#genericModal .modal-body").html(t),e.button("reset"),o.modal("show")}).fail(function(t){e.button("reset"),alert("deu tiuti")})}function showCategory(t,e){const o=$("#genericModal");$.get("/admin/categorias/"+t).done(function(t){$("#genericModal .modal-body").html(t),o.modal("show")}).fail(function(t){alert("deu tiuti")})}function deleteCategory(t,e){confirm("Você tem certeza dessa ação ?")&&($("#delete-category-form").attr("action","/admin/categorias/"+t),$("#delete-category-form").submit())}function editProduct(t,e){const o=$("#genericModal");e=$(e),$.get("/admin/produtos/"+t).done(function(t){$("#genericModal .modal-title").html("Edição de Produto"),$("#genericModal .modal-body").html(t),e.button("reset"),o.modal("show")}).fail(function(t){e.button("reset"),alert("deu tiuti")})}function showProduct(t,e){const o=$("#genericModal");$.get("/admin/produtos/"+t).done(function(t){$("#genericModal .modal-body").html(t),o.modal("show")}).fail(function(t){alert("deu tiuti")})}function deleteProduct(t){confirm("Você tem certeza dessa ação ?")&&($("#delete-product-form").attr("action","/admin/produtos/"+t),$("#delete-product-form").submit())}function eanPicker(){$("#eanModal").modal("show")}function editUser(t,e){const o=$("#genericModal");e=$(e),$.get("/admin/usuarios/"+t).done(function(t){$("#genericModal .modal-body").html(t),e.button("reset"),o.modal("show")}).fail(function(t){e.button("reset"),alert("deu tiuti")})}function showUser(t,e){const o=$("#genericModal");$.get("/admin/usuarios/"+t).done(function(t){$("#genericModal .modal-body").html(t),o.modal("show")}).fail(function(t){alert("deu tiuti")})}function deleteUser(t){confirm("Você tem certeza dessa ação ?")&&($("#delete-user-form").attr("action","/admin/usuarios/"+t),$("#delete-user-form").submit())}window.sessionStorage.getItem("items")&&(items=window.sessionStorage.getItem("items"),items=JSON.parse(items),$("#spccounter").html(items.length)),updateTable(),$("#categories-table").DataTable({language:{url:"https://cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"}}),$(".edit-category").click(function(){$(this).button("loading"),console.log($(this).attr("category-id")),editcategory($(this).attr("category-id"),$(this))}),$(".show-category").click(function(){$(this).button("loading"),console.log($(this).attr("category-id")),showcategory($(this).attr("category-id"),$(this))}),$(".delete-category").click(function(){$(this).button("loading"),console.log($(this).attr("category-id")),deleteCategory($(this).attr("category-id"),$(this))}),$("#products-table").DataTable({language:{url:"https://cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"}}),$(".edit-product").click(function(){$(this).button("loading"),console.log($(this).attr("product-id")),editProduct($(this).attr("product-id"),$(this))}),$(".show-product").click(function(){$(this).button("loading"),console.log($(this).attr("product-id")),showProduct($(this).attr("product-id"),$(this))}),$(".delete-product").click(function(){$(this).button("loading"),console.log($(this).attr("product-id")),deleteProduct($(this).attr("product-id"),$(this))}),$("#category-filter").change(function(){$("#category-filter-form").submit()}),$("#users-table").DataTable({language:{url:"https://cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"}}),$(".edit-user").click(function(){$(this).button("loading"),console.log($(this).attr("user-id")),editUser($(this).attr("user-id"),$(this))}),$(".show-user").click(function(){$(this).button("loading"),console.log($(this).attr("user-id")),showUser($(this).attr("user-id"),$(this))}),$(".delete-user").click(function(){$(this).button("loading"),console.log($(this).attr("user-id")),deleteUser($(this).attr("user-id"),$(this))});
