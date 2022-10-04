<script>
    const userToken1 = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sYXJhdmVsX2Jhc2UudGVzdFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTY2NDg3MjcyOSwiZXhwIjoxNjY0ODc2MzI5LCJuYmYiOjE2NjQ4NzI3MjksImp0aSI6Ikg1Qzl6c1hXa2RDZmlVUmIiLCJzdWIiOjksInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.rR8xmovqgOhc3gzD-zp5PbQ69nZ9A8vPJX47M_Hc0FM";
    const userToken2 = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sYXJhdmVsX2Jhc2UudGVzdFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTY2NDg3MjcwMywiZXhwIjoxNjY0ODc2MzAzLCJuYmYiOjE2NjQ4NzI3MDMsImp0aSI6IjVIQURWVW1hbkx0Z0VZWVEiLCJzdWIiOjIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.DQJ6pPh27q73vLR-PJ80EHHA9NXY2l6D6td-Kdnz6jA";

    /** API
     * Editable:    http://laravel_base.test/api/events/{event}/editable
     * Release:     http://laravel_base.test/api/events/{event}/editable/release
     * Maintain:    http://laravel_base.test/api/events/{event}/editable/maintain
     **/
    Promise.all([
            fetch("http://laravel_base.test/api/events/1/editable", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    'Authorization': 'Bearer ' + userToken1,
                },
            }),
            fetch("http://laravel_base.test/api/events/1/editable", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    'Authorization': 'Bearer ' + userToken2,
                },
            }),
        ])
        .then(async ([res1, res2]) => {
            const a = await res1.json();
            const b = await res2.json();
            console.log(a);
            console.log(b);
        })
        .catch((error) => {
            console.log(error);
        });
</script>
