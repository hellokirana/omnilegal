document.addEventListener("DOMContentLoaded", function() {
    // Update Homes
    document.querySelectorAll(".save-home").forEach(btn => {
        btn.addEventListener("click", function() {
            let row = btn.closest("tr");
            let id = row.dataset.id;
            let data = {};
            row.querySelectorAll(".editable").forEach(td => {
                data[td.dataset.field] = td.innerText;
            });

            fetch(`/admin/home/${id}/update`, {
                method: "PUT",
                headers: { 
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Content-Type": "application/json" 
                },
                body: JSON.stringify(data)
            });
        });
    });

    // Update Stats
    document.querySelectorAll(".save-stat").forEach(btn => {
        btn.addEventListener("click", function() {
            let row = btn.closest("tr");
            let id = row.dataset.id;
            let data = {};
            row.querySelectorAll(".editable-stat").forEach(td => {
                data[td.dataset.field] = td.innerText;
            });

            fetch(`/admin/stats/${id}/update`, {
                method: "PUT",
                headers: { 
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Content-Type": "application/json" 
                },
                body: JSON.stringify(data)
            });
        });
    });

    // Delete Stats
    document.querySelectorAll(".delete-stat").forEach(btn => {
        btn.addEventListener("click", function() {
            let row = btn.closest("tr");
            let id = row.dataset.id;

            fetch(`/admin/stats/${id}/delete`, {
                method: "DELETE",
                headers: { "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content }
            }).then(() => row.remove());
        });
    });

    // Create new Stat
    document.getElementById("addStatBtn")?.addEventListener("click", function() {
        let tbody = document.querySelector("#statsTable tbody");
        let newRow = document.createElement("tr");
        newRow.innerHTML = `
            <td>new</td>
            <td>upload later</td>
            <td contenteditable="true" data-field="label_id"></td>
            <td contenteditable="true" data-field="label_en"></td>
            <td contenteditable="true" data-field="value"></td>
            <td contenteditable="true" data-field="status"></td>
            <td><button class="btn btn-sm btn-success save-new-stat">Save</button></td>
        `;
        tbody.appendChild(newRow);

        newRow.querySelector(".save-new-stat").addEventListener("click", function() {
            let data = {};
            newRow.querySelectorAll("[contenteditable]").forEach(td => {
                data[td.dataset.field] = td.innerText;
            });

            fetch(`/admin/stats/store`, {
                method: "POST",
                headers: { 
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Content-Type": "application/json" 
                },
                body: JSON.stringify(data)
            }).then(res => res.json()).then(json => {
                if (json.success) location.reload();
            });
        });
    });
});
