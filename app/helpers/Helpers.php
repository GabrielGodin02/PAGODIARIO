<?php

class Helpers
{
    public function showResult(
        $result, 
        bool $showError = true, 
        bool $showSuccess = false)
    {
        if ($result && $showSuccess) {?>
            <script>
                Swal.fire({
                    icon: "error",
                    title: "Algo Salio Mal",
                    text: "Error En la Autenticacion!",
                })
            </script>
        <?php
        } elseif ($showError){ ?>
            <script>
                Swal.fire({
                    icon: "error",
                    title: "Algo Salio Mal",
                    text: "Error En la Autenticacion!",
                })
            </script>
        <?php
        }
    }
}
