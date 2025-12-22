import time
import os
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC

# ============================================================
# BASIC CONFIG
# ============================================================

# base url project laravel
# make sureeeee php artisan serve dah jalan di port 8000 okeh
BASE_URL = "http://127.0.0.1:8000"

# pages pentink
LOGIN_URL = f"{BASE_URL}/login"           # login admin
MANAGE_URL = f"{BASE_URL}/about/manage"   # admin CRUD page
PUBLIC_URL = f"{BASE_URL}/about"           # public page

# ============================================================
# ADMIN ACCOUNT (TESTING ONLY)
# ============================================================

# akun admin buat automation testing
# hardcode cuma buat test lokal heheheheheheh
ADMIN_EMAIL = "admin@tmarket.com"
ADMIN_PASS = "password"

# ============================================================
# FILE SETUP
# ============================================================

# ambil folder tempat script ini dirun
# biar path file gk error aneh-aneh
CURRENT_DIR = os.getcwd()

# image valid buat test upload
IMAGE_PATH = os.path.join(CURRENT_DIR, "test.jpg")

# file invalid (pdf) buat ngetes validation
INVALID_FILE_PATH = os.path.join(CURRENT_DIR, "dummy.pdf")

# bikin dummy pdf kalo belum ada
# jadi ga perlu bikin manual tiap run
if not os.path.exists(INVALID_FILE_PATH):
    with open(INVALID_FILE_PATH, "w") as f:
        f.write("Not an image")

# ============================================================
# CHROME DRIVER SETUP
# ============================================================

options = webdriver.ChromeOptions()

# keep browser kebuka setelah script selesai
# soalnya sering perlu dicek manual
options.add_experimental_option("detach", True)

# disable popup chrome yg ganggu automation
prefs = {
    "credentials_enable_service": False,
    "profile.password_manager_enabled": False
}
options.add_experimental_option("prefs", prefs)

options.add_argument("--disable-features=PasswordLeakDetection")
options.add_argument("--ignore-certificate-errors")

# start chrome
driver = webdriver.Chrome(options=options)

# fullscreen 
driver.maximize_window()

# explicit wait, lebih aman daripada sleep doang
wait = WebDriverWait(driver, 10)

# ============================================================
# HELPER FUNCTION
# ============================================================

def zoom_snap(filename):
    """
    helper buat ss
    zoom out dikit bikoz kadang kepotong
    """
    try:
        driver.execute_script("document.body.style.zoom='67%'")
        time.sleep(0.5)  # nunggu layout bener
        driver.save_screenshot(filename)
        driver.execute_script("document.body.style.zoom='100%'")
        print(f"   [EVIDENCE] Screenshot saved: {filename}")
    except:
        print(f"   [WARNING] Screenshot failed: {filename}")

# ============================================================
# MAIN TEST FLOW
# ============================================================

try:
    print("--- START ADMIN CRUD TEST ---")

    # reminder kalo image belum ada
    if not os.path.exists(IMAGE_PATH):
        print("WARNING: test.jpg belum ada, upload image might fail")

    # ========================================================
    # STEP 0: LOGIN ADMIN
    # ========================================================
    print("\n[Step 0] Login as Admin...")
    driver.get(LOGIN_URL)

    # tunggu field email sampe clickable
    # pernah error karena bikoz selenium terlalu cepet mngetik huftz
    email_field = wait.until(EC.element_to_be_clickable((By.NAME, "email")))
    email_field.click()
    email_field.clear()
    email_field.send_keys(ADMIN_EMAIL)

    # input password + enter
    pass_field = driver.find_element(By.NAME, "password")
    pass_field.click()
    pass_field.clear()
    pass_field.send_keys(ADMIN_PASS + Keys.RETURN)

    # cek login berhasil atau engga
    # kalo url udah bukan /login berarti sukses
    print("   -> Checking login redirect...")
    try:
        WebDriverWait(driver, 10).until(lambda d: "login" not in d.current_url)
        print("   -> Login success")
    except:
        print("   -> Still on login page, credential mungkin salah")

    # ========================================================
    # TC.001: UI SANITY CHECK
    # ========================================================
    print("\n[TC.001] UI Sanity Check...")
    driver.get(MANAGE_URL)

    try:
        # cuma buat ngecek page kebuka dan button utama ada
        wait.until(
            EC.presence_of_element_located(
                (By.XPATH, "//button[contains(text(), 'Add Section')]")
            )
        )
        zoom_snap("evidence_01_ui_check.png")
        print("   -> Admin page loaded correctly")
    except:
        print("   -> Add Section button ga ketemu")
        zoom_snap("debug_TC001_fail.png")

    # ========================================================
    # TC.002: CREATE VALIDATION (EMPTY INPUT)
    # ========================================================
    print("\n[TC.002] Create Validation - Empty Input...")

    try:
        # klik submit tanpa isi field apapun
        submit_btn = wait.until(
            EC.element_to_be_clickable(
                (By.CSS_SELECTOR, "form[action*='store'] button[type='submit']")
            )
        )
        submit_btn.click()
        time.sleep(1)

        # cek pesan validation
        if "field is required" in driver.page_source:
            zoom_snap("evidence_02_create_empty.png")
            print("   -> Validation empty input works")
        else:
            print("   -> Validation message ga muncul")
    except:
        print("   -> Form ga bisa di-submit")

    # ========================================================
    # TC.003: CREATE VALIDATION (INVALID FILE)
    # ========================================================
    print("\n[TC.003] Create Validation - Invalid File...")
    driver.refresh()

    try:
        driver.find_element(By.NAME, "title").send_keys("Test PDF")
        driver.find_element(By.NAME, "content").send_keys("Testing invalid upload")

        # upload pdf (harusnya ditolak)
        driver.find_element(By.NAME, "image").send_keys(INVALID_FILE_PATH)
        driver.find_element(
            By.CSS_SELECTOR, "form[action*='store'] button[type='submit']"
        ).click()

        time.sleep(1)

        if "image" in driver.page_source or "type" in driver.page_source:
            zoom_snap("evidence_03_create_invalid_file.png")
            print("   -> Invalid file successfully rejected")
        else:
            print("   -> Error message ga ketangkep")
    except Exception as e:
        print(f"   -> Error pas test invalid file: {e}")

    # ========================================================
    # TC.004: CREATE SUCCESS
    # ========================================================
    print("\n[TC.004] Create Success...")
    driver.refresh()

    try:
        driver.find_element(By.NAME, "title").send_keys("Our Vision")
        driver.find_element(By.NAME, "content").send_keys("To be the best.")

        # upload image valid
        if os.path.exists(IMAGE_PATH):
            driver.find_element(By.NAME, "image").send_keys(IMAGE_PATH)

        driver.find_element(
            By.CSS_SELECTOR, "form[action*='store'] button[type='submit']"
        ).click()

        # upload image kadang lama, jadi kasih delay ajah
        time.sleep(3)

        if "Section added successfully" in driver.page_source:
            zoom_snap("evidence_04_create_success.png")
            print("   -> Create section success")
        else:
            zoom_snap("debug_TC004_fail.png")
            print("   -> Success message ga muncul")
    except Exception as e:
        print(f"   -> Error pas create data: {e}")

    # ========================================================
    # TC.005: PUBLIC VIEW CHECK
    # ========================================================
    print("\n[TC.005] Public View Check...")
    driver.get(PUBLIC_URL)
    time.sleep(2)

    # pastiin data yg dibuat muncul di frontend
    if "Our Vision" in driver.page_source:
        zoom_snap("evidence_05_public_view.png")
        print("   -> Data muncul di halaman public")
    else:
        print("   -> Data ga muncul di public page")

    # ========================================================
    # TC.006: UPDATE VALIDATION
    # ========================================================
    print("\n[TC.006] Update Validation...")
    driver.get(MANAGE_URL)

    try:
        # cari input dengan value "Our Vision"
        title_input = wait.until(
            EC.presence_of_element_located(
                (By.XPATH, "//input[@value='Our Vision']")
            )
        )

        # kosongin title biar kena validation
        title_input.clear()

        update_btn = title_input.find_element(
            By.XPATH, "./ancestor::form//button[contains(text(), 'Save Changes')]"
        )
        update_btn.click()
        time.sleep(1)

        if "field is required" in driver.page_source:
            zoom_snap("evidence_06_update_validation.png")
            print("   -> Update validation works")
    except:
        print("   -> Data target ga ketemu")

    # ========================================================
    # TC.007: UPDATE SUCCESS
    # ========================================================
    print("\n[TC.007] Update Success...")
    driver.get(MANAGE_URL)

    try:
        title_input = wait.until(
            EC.presence_of_element_located(
                (By.XPATH, "//input[@value='Our Vision']")
            )
        )

        title_input.clear()
        title_input.send_keys("Our New Vision")

        update_btn = title_input.find_element(
            By.XPATH, "./ancestor::form//button[contains(text(), 'Save Changes')]"
        )
        update_btn.click()
        time.sleep(2)

        if "Section updated successfully" in driver.page_source:
            zoom_snap("evidence_07_update_success.png")
            print("   -> Update success")
    except:
        print("   -> Update gagal, data ga ketemu")

    # ========================================================
    # TC.008 & TC.009: DELETE
    # ========================================================
    print("\n[TC.008 / TC.009] Delete Test...")
    driver.get(MANAGE_URL)
    time.sleep(2)

    try:
        delete_buttons = driver.find_elements(By.CLASS_NAME, "fa-trash")

        if delete_buttons:
            # TC.008: cancel delete
            delete_buttons[-1].click()
            time.sleep(1)
            driver.switch_to.alert.dismiss()
            print("   -> Delete cancelled (TC.008 works)")
            zoom_snap("evidence_08_delete_cancel.png")

            # TC.009: confirm delete
            delete_buttons[-1].click()
            time.sleep(1)
            driver.switch_to.alert.accept()
            time.sleep(2)

            if "Section deleted successfully" in driver.page_source:
                zoom_snap("evidence_09_delete_success.png")
                print("   -> Delete success (TC.009 works)")
        else:
            print("   -> No delete button found")
    except Exception as e:
        print(f"   -> Error pas delete: {e}")

    print("\n--- TEST FINISHED ---")

except Exception as e:
    print(f"\nCRITICAL ERROR: {e}")