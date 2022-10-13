<script>
    const userToken1 = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sYXJhdmVsX2Jhc2UudGVzdFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTY2NTY1MzcyNSwiZXhwIjoxNjY1NjU3MzI1LCJuYmYiOjE2NjU2NTM3MjUsImp0aSI6IkV4SDJUSEx2VUUwcEJqZ3QiLCJzdWIiOjUsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.hL-gOyRyeZkowmNhm4-KHadICf5NZTzDi__9UCwVsDA";
    const userToken2 = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sYXJhdmVsX2Jhc2UudGVzdFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTY2NTY1Mzc1MiwiZXhwIjoxNjY1NjU3MzUyLCJuYmYiOjE2NjU2NTM3NTIsImp0aSI6IjFsOWtCbjg2OXd0bGpZWkUiLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.xZX6w2kDRymjgitUMGiapBZy_t6MXQ4z2Lo-bghloHM";

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
