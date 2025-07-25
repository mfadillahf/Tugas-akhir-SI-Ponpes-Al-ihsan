document.addEventListener("DOMContentLoaded",function(){const n=document.querySelector('meta[name="flash-success"]'),a=document.querySelector('meta[name="flash-error"]');n!=null&&n.content&&Swal.fire({icon:"success",title:"Berhasil",text:n.content,timer:2e3,showConfirmButton:!1}),a!=null&&a.content&&Swal.fire({icon:"error",title:"Gagal",text:a.content,showConfirmButton:!0}),$(document).on("click",".btn-delete",function(e){e.preventDefault();const t=$(this).closest("form");Swal.fire({title:"Yakin ingin menghapus?",text:"Data tidak bisa dikembalikan!",icon:"warning",showCancelButton:!0,confirmButtonText:"Ya, hapus!",cancelButtonText:"Batal",customClass:{confirmButton:"btn btn-danger me-3 waves-effect waves-light",cancelButton:"btn btn-outline-secondary waves-effect"},buttonsStyling:!1}).then(i=>{i.isConfirmed?t.submit():i.dismiss===Swal.DismissReason.cancel&&Swal.fire({title:"Dibatalkan",text:"Data tidak jadi dihapus.",icon:"info",customClass:{confirmButton:"btn btn-primary waves-effect"},buttonsStyling:!1})})}),$(document).on("click",'button[data-bs-toggle="modal"]',function(){const e=$(this).data("id");$("#modalBody").html('<p class="text-center">Memuat...</p>'),$.ajax({url:"/agenda/"+e+"/detail",type:"GET",success:function(t){var i=`
                        <table class="table table-sm table-bordered">
                            <tbody>
                                <tr>
                                    <th>Judul</th>
                                    <td>${t.judul}</td>
                                </tr>
                                <tr>
                                    <th>Jenis agenda</th>
                                    <td>${t.kategori}</td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td>${t.deskripsi}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <td>${t.tanggal_mulai}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Akhir</th>
                                    <td>${t.tanggal_akhir}</td>
                                </tr>
                            </tbody>
                        </table>
                    `;$("#modalBody").html(i)},error:function(){alert("Gagal mengambil data detail agenda.")}})});const o=$(".datatables-basic");if(o.length){const e=o.DataTable({dom:'<"card-header flex-column flex-md-row border-bottom py-2 px-3"<"head-label"><"dt-action-buttons text-end pt-2 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',responsive:!0,pageLength:10,lengthMenu:[10,25,50,100],columnDefs:[{targets:0,orderable:!1,className:"dt-checkboxes-cell",checkboxes:{selectRow:!0},render:function(){return'<input type="checkbox" class="dt-checkboxes form-check-input">'}}],select:{style:"multi",selector:"td:first-child"},language:{paginate:{next:'<i class="ri-arrow-right-s-line"></i>',previous:'<i class="ri-arrow-left-s-line"></i>'}},buttons:[{extend:"collection",className:"btn btn-label-primary dropdown-toggle me-4 waves-effect waves-light",text:'<i class="ri-external-link-line me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',buttons:[{extend:"print",text:'<i class="ri-printer-line me-1"></i>Print',className:"dropdown-item",exportOptions:{columns:[1,2,3,4,5]}},{extend:"csv",text:'<i class="ri-file-text-line me-1"></i>Csv',className:"dropdown-item",exportOptions:{columns:[1,2,3,4,5]}},{extend:"excel",text:'<i class="ri-file-excel-line me-1"></i>Excel',className:"dropdown-item",exportOptions:{columns:[1,2,3,4,5]}},{extend:"pdf",text:'<i class="ri-file-pdf-line me-1"></i>Pdf',className:"dropdown-item",exportOptions:{columns:[1,2,3,4,5]}},{extend:"copy",text:'<i class="ri-file-copy-line me-1"></i>Copy',className:"dropdown-item",exportOptions:{columns:[1,2,3,4,5]}}]}]});e.on("draw",function(){const t=$(e.table().body());t.unhighlight(),e.search()&&t.highlight(e.search())})}});
