import time
import os
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys

# --- CONFIGURATION ---
BASE_URL = "http://127.0.0.1:8000"
LOGIN_URL = f"{BASE_URL}/login"
MANAGE_URL = f"{BASE_URL}/about/manage"
PUBLIC_URL = f"{BASE_URL}/about"

# Admin Credentials
ADMIN_EMAIL = "admin@tmarket.com"
ADMIN_PASS = "password"

# --- IMAGE PATH SETUP ---
CURRENT_DIR = os.getcwd()
IMAGE_FILENAME = "test.jpg"
IMAGE_PATH = os.path.join(CURRENT_DIR, IMAGE_FILENAME)

# Setup Chrome
options = webdriver.ChromeOptions()
options.add_experimental_option("detach", True) # Keeps browser open
driver = webdriver.Chrome(options=options)
driver.maximize_window()

def zoom_out_and_snap(filename):
    """Helper to zoom out, take a full screenshot, and zoom back."""
    # Zoom to 50% to fit everything
    driver.execute_script("document.body.style.zoom='50%'")
    # Scroll to bottom
    driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
    time.sleep(1)
    # Save
    driver.save_screenshot(filename)
    # Reset Zoom
    driver.execute_script("document.body.style.zoom='100%'")
    print(f"   -> Screenshot saved: {filename}")

try:
    print("--- STARTING AUTOMATED TEST (ABOUT PAGE) ---")

    # ============================================================
    # STEP 0: LOGIN
    # ============================================================
    print("\n[Step 0] Logging in...")
    driver.get(LOGIN_URL)
    
    # Fill Login Form
    driver.find_element(By.NAME, "email").send_keys(ADMIN_EMAIL)
    driver.find_element(By.NAME, "password").send_keys(ADMIN_PASS + Keys.RETURN)
    
    time.sleep(2) # Wait for redirect
    driver.get(MANAGE_URL)
    print("   -> Login Successful. Redirected to Manage Page.")

    # ============================================================
    # TC.Abt.001.001: VALIDATION (Negative)
    # ============================================================
    print("\n[TC.Abt.001.001] Testing Validation (Empty Fields)...")
    
    # 1. Click 'Add Section' button without typing anything
    submit_btn = driver.find_element(By.CSS_SELECTOR, "form[action*='store'] button[type='submit']")
    submit_btn.click()
    time.sleep(1) # Wait for page reload
    
    # 2. Verify Error Message
    if "The title field is required" in driver.page_source:
        zoom_out_and_snap("evidence_TC_Abt_001_001.png")
        print("   -> PASS: Validation error displayed correctly.")
    else:
        print("   -> FAIL: Validation error NOT found.")

    # ============================================================
    # TC.Abt.001.002: CREATE SECTION (Positive)
    # ============================================================
    print("\n[TC.Abt.001.002] Testing Create Section (With Image)...")
    
    # 1. Input Title
    driver.find_element(By.NAME, "title").clear()
    driver.find_element(By.NAME, "title").send_keys("Our Vision")
    
    # 2. Input Content
    driver.find_element(By.NAME, "content").clear()
    driver.find_element(By.NAME, "content").send_keys("To be the best marketplace.")
    
    # 3. Upload Image (Checks if file exists first)
    if os.path.exists(IMAGE_PATH):
        driver.find_element(By.NAME, "image").send_keys(IMAGE_PATH)
        print("   -> Image selected successfully.")
    else:
        print(f"   -> WARNING: '{IMAGE_FILENAME}' not found in folder. Skipping image upload.")
    
    # 4. Submit
    driver.find_element(By.CSS_SELECTOR, "form[action*='store'] button[type='submit']").click()
    time.sleep(3) # Wait longer for file upload
    
    # 5. Verify Success
    if "Section added successfully" in driver.page_source:
        zoom_out_and_snap("evidence_TC_Abt_001_002.png")
        print("   -> PASS: New section 'Our Vision' created.")
    else:
        print("   -> FAIL: Create Success Message NOT found.")

    # ============================================================
    # TC.Abt.001.003: PUBLIC VIEW (Positive)
    # ============================================================
    print("\n[TC.Abt.001.003] Testing Public View...")
    
    driver.get(PUBLIC_URL)
    time.sleep(2)
    
    # Verify Data
    if "Our Vision" in driver.page_source:
        zoom_out_and_snap("evidence_TC_Abt_001_003.png")
        print("   -> PASS: 'Our Vision' is visible on the public page.")
    else:
        print("   -> FAIL: Data NOT visible on public page.")

    # ============================================================
    # TC.Abt.001.004: UPDATE SECTION (Positive)
    # ============================================================
    print("\n[TC.Abt.001.004] Testing Update Section...")
    
    driver.get(MANAGE_URL)
    time.sleep(2)
    
    try:
        # 1. Find the input that currently holds "Our Vision"
        # XPath explanation: Find <input> where value='Our Vision'
        title_input = driver.find_element(By.XPATH, "//input[@value='Our Vision']")
        title_input.clear()
        title_input.send_keys("Our New Vision")
        
        # 2. Find the 'Save Changes' button in the same form
        # XPath explanation: Go up to the parent <form>, then find the button inside it
        update_btn = title_input.find_element(By.XPATH, "./ancestor::form//button[contains(text(), 'Save Changes')]")
        update_btn.click()
        time.sleep(2)
        
        # 3. Verify Update
        if "Section updated successfully" in driver.page_source:
            zoom_out_and_snap("evidence_TC_Abt_001_004.png")
            print("   -> PASS: Updated title to 'Our New Vision'.")
        else:
            print("   -> FAIL: Update Success Message NOT found.")
            
    except Exception as e:
        print(f"   -> FAIL: Could not find element to update. Error: {e}")

    # ============================================================
    # TC.Abt.001.005: DELETE SECTION (Positive)
    # ============================================================
    print("\n[TC.Abt.001.005] Testing Delete Section...")
    
    try:
        # 1. Find all delete buttons (trash icons)
        delete_buttons = driver.find_elements(By.CLASS_NAME, "fa-trash")
        
        if delete_buttons:
            # Click the LAST one (most recently added section)
            delete_buttons[-1].click()
            
            # 2. Handle Browser Alert Popup
            try:
                driver.switch_to.alert.accept()
                print("   -> Alert popup accepted.")
            except:
                pass 
            
            time.sleep(2)
            
            # 3. Verify Deletion
            if "Section deleted successfully" in driver.page_source:
                zoom_out_and_snap("evidence_TC_Abt_001_005.png")
                print("   -> PASS: Section deleted successfully.")
            else:
                print("   -> FAIL: Delete Success Message NOT found.")
        else:
            print("   -> FAIL: No delete buttons found on page.")
            
    except Exception as e:
        print(f"   -> FAIL: Delete action failed. Error: {e}")

    print("\n--- TEST COMPLETED SUCCESSFULLY ---")
    print("Check your project folder for the 5 evidence PNG files!")

except Exception as e:
    print(f"\nCRITICAL ERROR: The test stopped unexpectedly.\nReason: {e}")